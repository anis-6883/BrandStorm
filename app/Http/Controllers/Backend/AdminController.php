<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Admin Authentication
    public function index(Request $req)
    {
        if(session()->has('admin_login'))
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

            $admin = User::where([['email', $email], ['user_type', 'Admin']])->first();

            if(!empty($admin))
            {
                if(Hash::check($password, $admin->password))
                {
                    session()->put('admin_login', [
                        'admin_id' => $admin->id,
                        'admin_username' => $admin->username,
                        'admin_email' => $admin->email,
                        'admin_login_time' => date('Y-m-d H:i:s')
                    ]);
                    session()->flash('success', 'Login Successfully!');
                    return redirect()->route('admin.dashboard');
                }
                session()->flash('error', 'Your provided credential could not be varified!');
                return redirect()->back();
            }
            session()->flash('error', 'Your provided credential could not be varified!');
            return redirect()->back();
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
        // auth()->logout();
        if(session()->has('admin_login'))
            session()->forget('admin_login');

        session()->flash('success', 'GoodBye! Logout Successfully.');
        return redirect()->route('admin.index');
    }
}
