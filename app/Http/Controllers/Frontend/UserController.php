<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $req)
    {
        if(!$req->isMethod('POST'))
            return view('frontend.auth.register');
        else
        {
            $attributes = $req->validate([
                'username' => ['required', 'unique:users,username', 'min:8', 'max:255'],
                'email' => ['required', 'unique:users,email', 'email', 'max:255'],
                'password' => ['required', 'confirmed', 'min:8', 'max:255']
            ]);

            $random_token = "RANDOM_" .  uniqid() . rand(100000, 999999). "_TOKEN";
            $attributes['password'] = bcrypt($attributes['password']); # -> Also Handle By Model
            $attributes['remember_token'] = $random_token;
            User::create($attributes);

            session()->flash('success', 'Registration Successfully Done! Login Now...');
            return redirect()->route('user.login');
        }
    }

    public function login(Request $req)
    {
        if(!$req->isMethod('POST'))
            return view('frontend.auth.login');
        else
        {
            $req->validate([
                'user_email' => 'required|email',
                'user_password' => 'required'
            ]);
    
            $email = $req->user_email;
            $password = $req->user_password;

            if(!auth()->attempt([
                'email' => $email, 
                'password'=> $password, 
                'user_status' => 'Active', 
                'user_type' => 'Regular'])
            )
            {
                session()->flash('error', 'Your provided credential could not be varified!');
                return redirect()->back();
            }
            
            session()->regenerate();
            return redirect()->route('home');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('user.login')->with('success', 'GoodBye! Logout Successfully.');
    }

    public function myOrders()
    {
        $orders = Order::with('package')->where('user_id', Auth::user()->id)->latest()->get();
        return view('frontend.user-order-list', compact('orders'));
    }

}
