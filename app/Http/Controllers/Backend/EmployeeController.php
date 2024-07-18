<?php

namespace App\Http\Controllers\Backend;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;

class EmployeeController extends Controller
{
    public function allEmployee()
    {
        $employee = Employee::latest()->get();

        return view('backend.employee.all_employee', compact('employee'));
    }

    public function addEmployee()
    {
        return view('backend.employee.add_employee');
    }

    public function storeEmployee(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:employees|max:100',
            'email' => 'required|unique:employees|max:100',
            'phone' => 'required|max:100',
            'address' => 'required|max:400',
            'salary' => 'required|max:100',
            'vacation' => 'required|max:100',
            'experience' => 'required|max:100',
            'city' => 'required|max:100',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //65784365873.jpg
        Image::read($image)->resize(300, 300)->save('upload/employee/' . $name_gen);
        $save_url = 'upload/employee/' . $name_gen;

        Employee::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $toastr = array(
            'success' => 'Employee Data Inserted.'
        );

        return redirect()->route('all.employee')->with($toastr);
    }

    public function editEmployee($id)
    {
        $employee = Employee::findOrFail($id);

        return view('backend.employee.edit_employee', compact('employee'));
    }

    public function updateEmployee(Request $request)
    {
        $employee_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //65784365873.jpg
            Image::read($image)->resize(300, 300)->save('upload/employee/' . $name_gen);
            $save_url = 'upload/employee/' . $name_gen;

            $employee_img = Employee::findOrFail($employee_id);
            $img = $employee_img->image;
            unlink($img);

            Employee::findOrFail($employee_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'image' => $save_url,
            ]);
            $toastr = array(
                'success' => 'Employee with Image Updated.'
            );

            return redirect()->route('all.employee')->with($toastr);
        } else {
            Employee::findOrFail($employee_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
            ]);
            $toastr = array(
                'success' => 'Employee Data Updated.'
            );

            return redirect()->route('all.employee')->with($toastr);
        };
    }

    public function deleteEmployee($id)
    {
        $employee_img = Employee::findOrFail($id);
        $img = $employee_img->image;
        unlink($img);

        Employee::findOrFail($id)->delete();

        $toastr = array(
            'success' => 'Successfuly Delete Data.'
        );

        return redirect()->back()->with($toastr);
    }
}
