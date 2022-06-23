<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Admin Authentication
    public function index(Request $req)
    {
        if(Auth::check())
            return redirect()->route('admin.dashboard');
            
        if(!$req->isMethod('POST'))
            return view('backend.auth.index');
        else
        {
            $req->validate([
                'admin_email' => 'required|email',
                'admin_password' => 'required'
            ]);
    
            $email = $req->admin_email;
            $password = $req->admin_password;

            if(!auth()->attempt([
                'email' => $email, 
                'password'=> $password, 
                'user_status' => 'Active', 
                'user_type' => 'Admin'])
            )
            {
                session()->flash('error', 'Your provided credential could not be varified!');
                return redirect()->back();
            }

            session()->flash('success', 'Login Successfully!');
            return redirect()->route('admin.dashboard');
        }
    }

    // Admin Dashboard
    public function dashboard()
    {
        return view('backend.dashboard');
    }

    // Admin Logout
    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.index')->with('success', 'GoodBye! Logout Successfully.');
    }
}
