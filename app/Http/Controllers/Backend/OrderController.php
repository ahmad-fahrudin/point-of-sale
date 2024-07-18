<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function finalInvoice(Request $request)
    {
        $rtotal = $request->total;
        $rpay = $request->pay;
        $mtotal = $rtotal - $rpay;

        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_product'] = $request->total_product;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;

        $data['payment_status'] = $request->payment_status;
        $data['invoice_no'] = 'EPOS' . mt_rand(10000000, 99999999);
        $data['pay'] = $request->pay;
        $data['due'] = $mtotal;
        $data['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();

        $pdata = array();
        foreach ($contents as $content) {
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $content->id;
            $pdata['qty'] = $content->qty;
            $pdata['unitcost'] = $content->price;
            $pdata['total'] = $content->total;

            $insert = OrderDetails::insert($pdata);
        } // end foreach

        $toastr = array(
            'success' => 'Order Complete Successfully.'
        );

        Cart::destroy();

        return redirect()->route('pos')->with($toastr);
    } // End Method

    public function pendingOrder()
    {
        $orders = Order::where('order_status', 'pending')->get();
        return view('backend.order.pending_order', compact('orders'));
    } // End Method

    public function orderDetails($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderItem = Orderdetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        return view('backend.order.order_details', compact('order', 'orderItem'));
    } // End Method

    public function orderStatusUpdate(Request $request)
    {
        $order_id = $request->id;
        $product = Orderdetails::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_store' => DB::raw('product_store-' . $item->qty)]);
        }
        Order::findOrFail($order_id)->update(['order_status' => 'complete']);

        $toastr = array(
            'success' => 'Order Done Successfully.'
        );

        return redirect()->route('pending.order')->with($toastr);
    } //end method

    public function completeOrder()
    {
        $orders = Order::where('order_status', 'complete')->get();
        return view('backend.order.complete_order', compact('orders'));
    } // End Method

    public function stockManage()
    {
        $product = Product::latest()->get();
        return view('backend.stock.all_stock', compact('product'));
    } // End Method

    public function orderInvoice($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderItem = OrderDetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('backend.order.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('invoice_pdf');
    } // End Method

    public function PendingDue()
    {
        $alldue = Order::where('due', '>', '0')->orderBy('id', 'DESC')->get();
        return view('backend.order.pending_due', compact('alldue'));
    } // End Method

    public function OrderDueAjax($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    } // End Method

    public function UpdateDue(Request $request)
    {
        $order_id = $request->id;
        $due_amount = $request->due;
        $pay_amount = $request->pay;

        $allorder = Order::findOrFail($order_id);
        $maindue = $allorder->due;
        $maindpay = $allorder->pay;

        $paid_due = $maindue - $due_amount;
        $paid_pay = $maindpay + $due_amount;

        Order::findOrFail($order_id)->update([
            'due' => $paid_due,
            'pay' => $paid_pay,
        ]);
        $notification = array(
            'success' => 'Due Amount Updated Successfully',
        );

        return redirect()->route('pending.due')->with($notification);
    } // End Method

}
