<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order, Product, Customer, OrderProduct};
use DataTables;

class OrderController extends Controller
{
    public function dashboard(Request $request) {
        if ($request->ajax()) {
            $data = Order::get();
            $user = auth()->user();
            return Datatables::of($data)
                ->addColumn('action', function($data) {
                    $url = route('order_details', ['id' => $data->id]);
                    $html = '<a href="'.$url.'" class="btn btn-primary" id="submit" > view details </a>';
                    return $html;
                })
                ->rawColumns([])
                ->make(true);
        }
        return view('dashboard');
    }

    public function add_order(Request $request) {
        if ($request->ajax()) {
            $customer = Customer::find($request->customer_name);
            $order = new Order;
            $order->customer_name = $customer->name;
            $order->product_count = $request->total_products;
            $order->amount = $request->order_total;
            $order->date = now();
            $order->save();

            foreach($request->products as $product) {
                $pr = new Product;
                $pr->name = $product['product_name'];
                $pr->price = $product['product_price'];
                $pr->save();

                $order_product = new OrderProduct;
                $order_product->order_id = $order->id;
                $order_product->product_id = $pr->id;
                $order_product->quantity = $product['product_quantity'];
                $order_product->total = $product['product_total'];
                $order_product->save();
            }

            $url = route('dashboard');
            return response()->json(['status' => true, 'message' => 'order added successfully', 'redirect' => $url]);
        }
        $customers = Customer::all();
        return view('add_order', compact('customers'));
    }

    public function order_details($id) {
        $order = Order::where('id', $id)->with('products')->first();
        return view('order_details', compact('order'));
        // echo "<pre>"; print_r($order->toArray()); exit();
    }
}
