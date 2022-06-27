<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Proceed To Order
    public function proceedToOrder($package_id)
    {
        if(!Auth::check())
        {
            session()->flash('warning', 'You have to Login for Place Order!');
            return redirect()->back();
        }

        $exists = Order::with('package')->where([['user_id', Auth::user()->id], ['order_status', 'Ordered']])->exists();
        if($exists)
        {
            session()->flash('warning', 'Please, Confirm your Current Order!');
            return redirect()->route('package.orderedPackage');
        }
        
        $order_obj = new Order;
        $package = Package::findOrFail($package_id);

        $order_obj->package_id = $package_id;
        $order_obj->user_id = Auth::user()->id;
        $order_obj->total_cost = $package->package_cost;

        $order_obj->save();
        session()->flash('success', 'Your Order Successfully Added Into Ordered List!');
        return redirect()->route('package.orderedPackage');
    }

    // Show Ordered Package
    public function orderedPackage()
    {
        $order = Order::with('package')->where([['user_id', Auth::user()->id], ['order_status', 'Ordered']])->first();
        if(empty($order))
        {
            session()->flash('warning', 'No Order Added Yet Into Ordered List!');
            return redirect()->route('home');
        }
        return view('frontend.ordered', compact('order'));
    }

    // Confirm Order
    public function confirmOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->order_status = "Pending";
        $order->payment_type = "Cash";
        $order->payment_method = "Cash";
        $order->transaction_id = "BRANDSTORM_" . uniqid(). rand(10000, 99999);
        $order->currency = "Doller";
        $order->invoice_no = "INVOICE_" . uniqid(). rand(10000, 99999);
        $order->order_date = date('Y-m-d H:i:s');
        $order->save();
        session()->flash('success', 'You Order Confirm Successfully... Stay With Us!');
        return redirect()->route('home');
    }

    // Delete Order
    public function deleteOrder($order_id)
    {
        $order = Order::with('package')->findOrFail($order_id);
        $package_title = $order->package->package_title;
        $order->delete();
        session()->flash('success', "Your \"$package_title\" Order has Deleted Successfully...");
        return redirect()->route('home');
    }
}
