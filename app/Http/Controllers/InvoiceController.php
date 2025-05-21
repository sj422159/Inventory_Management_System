<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\DB;



class InvoiceController extends Controller
{
    public function store(Request $request){
    	
$data = new Invoice;

$data->customer_name = $request->customer ?? 'NA';
$data->customer_mail = $request->email ?? 'NA';
$data->company       = $request->company ?? 'NA';
$data->address       = $request->address ?? 'NA';
$data->item          = $request->item ?? 'NA';
$data->product_name  = $request->name ?? 'NA';
$data->price         = $request->sale_price ?? 0;
$data->quantity      = $request->quantity ?? 0;
$data->total         = $request->total ?? 0;
$data->payment       = $request->payment ?? 0;

// Calculate due based on total and payment, ensuring defaults
$data->due = ($request->total ?? 0) - ($request->payment ?? 0);

$data->save();


        //order_track
        $productCode = Product::where('name',$request->name)->first();
        $data2=new Order;
        $data2->name= $request->name;
        $data2->product_code = $productCode->product_code;
        $data2->product_name = $request->name;
        $data2->quantity = $request->quantity;
        $data2->order_status = 1;
        $data2->save();

        //customer_track
        $customer = Customer::where('email', '=', $request->email)->first();
        if($customer === null){
           $data3 = new Customer;

$data3->name    = $request->customer ?? 'NA';
$data3->email = $request->email ?? 'na_' . uniqid() . '@example.com';
$data3->company = $request->company ?? 'NA';
$data3->address = $request->address ?? 'NA';
$data3->phone   = $request->phone ?? '0'; // or 'NA' if phone is string

$data3->save();

        }

        $products = DB::table('products')->where('category',$request->item)->first();
        $mainqty = $products->stock;
        $nowqty = $mainqty - $request->quantity;

        DB::table('products')->where('name',$request->name)->update(['stock' => $nowqty]);
        Order::where('name',$request->name)->update(['order_status'=>'1']);

        return view('Admin.invoice_details',compact('data'));


        // return Redirect()->route('add.invoice');
    }

    public function formData($id){
        $order = Order::where('id',$id)->first();
        $product = Product::where('product_code',$order->product_code)->first();
        $customer = Customer::where('email',$order->email)->first();
        return view('Admin.add_invoice',compact('order','product','customer'));

    }

    public function newformData(){
        $products = Product::all();
        $customers = Customer::all();
        return view('Admin.new_invoice',compact('products','customers'));
    }


    public function allInvoices(){
        $invoices = Invoice::all();
        return view('Admin.all_invoices',compact('invoices'));
    }

    public function soldProducts(){
        $products = Invoice::select('product_name', Invoice::raw("SUM(quantity) as count"))
        ->groupBy(Invoice::raw("product_name"))->get();
       // ?print_r($products);
        return view('Admin.sold_products',compact('products'));
    }

    public function delete(){
        Invoice::truncate();
    }
}
