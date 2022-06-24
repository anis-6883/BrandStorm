<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::where('package_status', 'Active')->limit(4)->get();
        $special_deal = Package::where('package_title', 'Facebook Basic Plan')->first();
        return view('frontend.index', compact('packages', 'special_deal'));
    }

    public function packageDetails($slug)
    {
        $package = Package::where('package_slug', $slug)->first();
        return view('frontend.show-package', compact('package'));
    }
}
