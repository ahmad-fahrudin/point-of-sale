<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        $toastr = array(
            'success' => 'Logout Successfully.'
        );

        return redirect('')->with($toastr);
    } // end method

    public function logoutPage()
    {
        return view('auth.logout');
    } // end method

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.profile_view', compact('adminData'));
    } // end method

    public function adminStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/' . $data->photo));

            $filename = date('YmdHi') . $file->getClientOriginalName(); // 6435746776574.name.jpg
            $file->move(public_path('upload/admin_image'), $filename);

            $data['photo'] = $filename;
        }
        $data->save();

        $toastr = array(
            'success' => 'Update Profile Successfully.'
        );

        return redirect()->back()->with($toastr);
    } // end method

    public function changePassword()
    {
        return view('admin.change_password');
    } // end method

    public function updatePassword(Request $request)
    {
        // validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // match the old password
        if (!hash::check($request->old_password, auth::user()->password)) {
            $toastr = array(
                'error' => 'Old Password Does Not Match!!.'
            );
            return back()->with($toastr);
        }

        // Update the New Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $toastr = array(
            'success' => 'Password Change Successfully.'
        );
        return back()->with($toastr);
    } // end method

    /////////////////////// Admin User All Method /////////////////////////////////

    public function AllUser()
    {
        $alladminuser = User::latest()->get();

        return view('backend.admin.all_admin', compact('alladminuser'));
    }

    public function AddUser()
    {
        $roles = Role::all();
        return view('backend.admin.add_admin', compact('roles'));
    } // End Method

    public function StoreUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->roles) {
            $role = Role::findById($request->roles); // Fetch the role by ID
            if ($role) {
                $user->assignRole($role->name); // Assign the role by name
            } else {
                return redirect()->back()->withErrors(['roles' => 'Role not found.']);
            }
        }

        $notification = array(
            'success' => 'New Admin User Created Successfully',
        );

        return redirect()->route('all.user')->with($notification);
    } // End Method

    public function EditUser($id)
    {

        $roles = Role::all();
        $adminuser = User::findOrFail($id);
        return view('backend.admin.edit_admin', compact('roles', 'adminuser'));
    } // End Method


    public function UpdateUser(Request $request)
    {

        $admin_id = $request->id;

        $user = User::findOrFail($admin_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $role = Role::findById($request->roles); // Fetch the role by ID
            if ($role) {
                $user->assignRole($role->name); // Assign the role by name
            } else {
                return redirect()->back()->withErrors(['roles' => 'Role not found.']);
            }
        }

        $notification = array(
            'success' => 'Admin User Updated Successfully',
        );

        return redirect()->route('all.user')->with($notification);
    } // End Method



    public function DeleteUser($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'success' => 'Admin User Deleted Successfully',
        );

        return redirect()->back()->with($notification);
    } // End Method

    //////////////// Database Backup Method //////////////////

    public function DatabaseBackup()
    {
        return view('admin.db_backup')->with('files', File::allFiles(storage_path('App\Laravel')));
    } // End Method

    public function BackupNow()
    {
        Artisan::call('backup:run');

        $notification = array(
            'success' => 'Database Backup Successfully',
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function DownloadDatabase($getFilename)
    {
        $path = storage_path('app\Laravel/' . $getFilename);
        return response()->download($path);
    } // End Method

    public function DeleteDatabase($getFilename)
    {
        Storage::delete('Laravel/' . $getFilename);

        $notification = array(
            'success' => 'Database Deleted Successfully',
        );
        return redirect()->back()->with($notification);
    } // End Method
}
