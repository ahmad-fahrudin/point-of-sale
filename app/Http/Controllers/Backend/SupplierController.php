<?php

namespace App\Http\Controllers\Backend;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Laravel\Facades\Image;

class SupplierController extends Controller
{
    public function allSupplier()
    {
        $supplier = Supplier::latest()->get();

        return view('backend.supplier.all_supplier', compact('supplier'));
    }

    public function addSupplier()
    {
        return view('backend.supplier.add_supplier');
    }

    public function storeSupplier(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:suppliers|max:100',
            'email' => 'required|unique:suppliers|max:100',
            'phone' => 'required|max:100',
            'address' => 'required|max:400',
            'shopname' => 'required',
            'type' => 'required',
            'account_holder' => 'required|max:100',
            'account_number' => 'required|max:100',
            'bank_name' => 'required|max:100',
            'bank_branch' => 'required',
            'city' => 'required|max:100',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //65784365873.jpg
        Image::read($image)->resize(300, 300)->save('upload/supplier/' . $name_gen);
        $save_url = 'upload/supplier/' . $name_gen;

        Supplier::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $toastr = array(
            'success' => 'Supplier Data Inserted.'
        );

        return redirect()->route('all.supplier')->with($toastr);
    }

    public function editSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('backend.supplier.edit_supplier', compact('supplier'));
    }

    public function updateSupplier(Request $request)
    {
        $supplier_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //65784365873.jpg
            Image::read($image)->resize(300, 300)->save('upload/supplier/' . $name_gen);
            $save_url = 'upload/supplier/' . $name_gen;

            $supplier_img = Supplier::findOrFail($supplier_id);
            $img = $supplier_img->image;
            unlink($img);

            Supplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $save_url,
            ]);
            $toastr = array(
                'success' => 'Supplier with Image Updated.'
            );

            return redirect()->route('all.supplier')->with($toastr);
        } else {
            Supplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
            ]);
            $toastr = array(
                'success' => 'Supplier Data Updated.'
            );

            return redirect()->route('all.supplier')->with($toastr);
        };
    }

    public function deleteSupplier($id)
    {
        $supplier_img = Supplier::findOrFail($id);
        $img = $supplier_img->image;
        unlink($img);

        Supplier::findOrFail($id)->delete();

        $toastr = array(
            'success' => 'Successfuly Delete Data.'
        );

        return redirect()->back()->with($toastr);
    }

    public function detailsupplier($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('backend.supplier.detail_supplier', compact('supplier'));
    }
}
