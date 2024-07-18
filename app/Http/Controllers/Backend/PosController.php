<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    public function pos()
    {
        $product = Product::latest()->get();
        $customer = Customer::latest()->get();

        return view('backend.pos.pos_page', compact('product', 'customer'));
    }

    public function addCart(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 20,
            'options' => ['size' => 'large'],
        ]);
        $toastr = array(
            'success' => 'Product Added Successfully.'
        );

        return redirect()->back()->with($toastr);
    }

    public function allItem()
    {
        $product_item = Cart::content();

        return view('backend.pos.text_item', compact('product_item'));
    }

    public function updateCart(Request $request, $rowId)
    {
        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);

        return redirect()->back();
    }

    public function deleteCart($rowId)
    {
        $delete = Cart::remove($rowId);

        return redirect()->back();
    }

    public function createInvoice(Request $request)
    {
        $contents = Cart::content();
        $cust_id = $request->customer_id;
        $customer = Customer::where('id', $cust_id)->first();

        return view('backend.invoice.product_invoice', compact('contents', 'customer'));
    }
}
