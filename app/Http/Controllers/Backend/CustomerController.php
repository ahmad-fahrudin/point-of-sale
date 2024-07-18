<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;

class CustomerController extends Controller
{
    public function allCustomer()
    {
        $customer = Customer::latest()->get();

        return view('backend.customer.all_customer', compact('customer'));
    }

    public function addCustomer()
    {
        return view('backend.customer.add_customer');
    }

    public function storeCustomer(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:customers|max:100',
            'email' => 'required|unique:customers|max:100',
            'phone' => 'required|max:100',
            'address' => 'required|max:400',
            'shopname' => 'required',
            'account_holder' => 'required|max:100',
            'account_number' => 'required|max:100',
            'bank_name' => 'required|max:100',
            'bank_branch' => 'required',
            'city' => 'required|max:100',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //65784365873.jpg
        Image::read($image)->resize(300, 300)->save('upload/customer/' . $name_gen);
        $save_url = 'upload/customer/' . $name_gen;

        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $toastr = array(
            'success' => 'Customer Data Inserted.'
        );

        return redirect()->route('all.customer')->with($toastr);
    }

    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        return view('backend.customer.edit_customer', compact('customer'));
    }

    public function updateCustomer(Request $request)
    {
        $customer_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //65784365873.jpg
            Image::read($image)->resize(300, 300)->save('upload/customer/' . $name_gen);
            $save_url = 'upload/customer/' . $name_gen;

            $Customer_img = Customer::findOrFail($customer_id);
            $img = $Customer_img->image;
            unlink($img);

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $save_url,
            ]);
            $toastr = array(
                'success' => 'Customer with Image Updated.'
            );

            return redirect()->route('all.customer')->with($toastr);
        } else {
            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
            ]);
            $toastr = array(
                'success' => 'Customer Data Updated.'
            );

            return redirect()->route('all.customer')->with($toastr);
        };
    }

    public function deleteCustomer($id)
    {
        $customer_img = Customer::findOrFail($id);
        $img = $customer_img->image;
        unlink($img);

        Customer::findOrFail($id)->delete();

        $toastr = array(
            'success' => 'Successfuly Delete Data.'
        );

        return redirect()->back()->with($toastr);
    }
}
