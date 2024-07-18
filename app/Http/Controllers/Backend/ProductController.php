<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function allProduct()
    {
        $product = Product::latest()->get();

        return view('backend.product.all_product', compact('product'));
    }

    public function addProduct()
    {
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();

        return view('backend.product.add_product', compact('category', 'supplier'));
    }

    public function storeProduct(Request $request)
    {
        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 6, 'prefix' => 'PC']);

        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //65784365873.jpg
        Image::read($image)->resize(300, 300)->save('upload/product/' . $name_gen);
        $save_url = 'upload/product/' . $name_gen;

        Product::insert([
            'product_name' => $request->product_name,
            'product_code' => $pcode,
            'category_id' => $request->category_id,
            'product_garage' => $request->product_garage,
            'supplier_id' => $request->supplier_id,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $toastr = array(
            'success' => 'Product Data Inserted.'
        );

        return redirect()->route('all.product')->with($toastr);
    }

    public function editProduct($id)
    {
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        $product = Product::findOrFail($id);

        return view('backend.product.edit_product', compact('category', 'supplier', 'product'));
    }

    public function updateProduct(Request $request)
    {
        $product_id = $request->id;

        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //65784365873.jpg
            Image::read($image)->resize(300, 300)->save('upload/product/' . $name_gen);
            $save_url = 'upload/product/' . $name_gen;

            Product::findOrFail($product_id)->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'product_garage' => $request->product_garage,
                'supplier_id' => $request->supplier_id,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'product_image' => $save_url,
            ]);
            $toastr = array(
                'success' => 'Product Data Updated.'
            );

            return redirect()->route('all.product')->with($toastr);
        } else {
            Product::findOrFail($product_id)->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'product_garage' => $request->product_garage,
                'supplier_id' => $request->supplier_id,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
            ]);
            $toastr = array(
                'success' => 'Product Data Updated.'
            );

            return redirect()->route('all.product')->with($toastr);
        }
    }

    public function deleteProduct($id)
    {
        $product_img = Product::findOrFail($id);
        $img = $product_img->product_image;
        unlink($img);

        Product::findOrFail($id)->delete();
        $toastr = array(
            'success' => 'Product Data Deleted.'
        );

        return redirect()->route('all.product')->with($toastr);
    }

    public function barcodeProduct($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.product.barcode_product', compact('product'));
    }
}
