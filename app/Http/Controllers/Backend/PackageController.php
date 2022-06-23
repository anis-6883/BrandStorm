<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PackageController extends Controller
{
    // Package List
    public function index()
    {
        $packages = Package::with('subcategory.category')->latest()->get();
        return view('backend.list-package', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_order')->get();
        return view('backend.add-package', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'subcategory_id' => 'required',
            'package_title' => 'required|min:8',
            'package_cost' => 'required|numeric',
            'package_description' => 'required',
            'subscription_type' => 'required',
            'package_status' => 'required',
            'product_image' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        // Not required (Default: NULL) 
        $valid_data['package_slug'] = strtolower(str_replace(str_split('\\/:*?"<>| '), '-', $request->package_title)) . '-' . uniqid() . rand(100000, 999999);
        $valid_data['package_summary'] = $request->package_summary;     
        $valid_data['duration_hour'] = $request->duration_hour;
        $valid_data['reach_head'] = $request->reach_head;
        $valid_data['print_ad_size'] = $request->print_ad_size;
        $valid_data['billboard_location'] = $request->billboard_location;
        $valid_data['video_length'] = $request->video_length;

        if(!empty($request->package_discount_pct))
        {
            $valid_data['package_discount_pct'] = $request->package_discount_pct;
            $valid_data['discount_start_date'] = $request->discount_start_date;
            $valid_data['discount_end_date'] = $request->discount_end_date;
        }else{
            $valid_data['product_discounted_price'] = NULL;
            $valid_data['discount_start_date'] = NULL;
            $valid_data['discount_end_date'] = NULL;
        }

        if($request->hasFile('package_image') and $request->file('package_image')->isValid())
        {
            $originalImageName = $request->file('package_image')->getClientOriginalName();
            $masterImageName = "PACKAGE_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $valid_data['package_image'] = $masterImageName;
        }

        Package::create($valid_data);

        if($request->hasFile('package_image') and $request->file('package_image')->isValid())
        {
            $request->package_image->move(public_path('/uploads/packages'), $masterImageName);
        }

        session()->flash('success', 'Package is Created Successfully!');
        return redirect()->route('package.index');
    }

    // Show Package Details
    public function show($id)
    {
        $package = Package::with('subcategory.category')->findOrFail($id);
        return view('backend.show-package', compact('package'));
    }

    // Edit Package Page
    public function edit($id)
    {
        $categories = Category::orderBy('category_order')->get();
        $package = Package::with('subcategory.category')->findOrFail($id);
        return view('backend.edit-package', compact('package', 'categories'));
    }

    // Update Package
    public function update(Request $request, $id)
    {
        $valid_data = $request->validate([
            'subcategory_id' => 'required',
            'package_title' => 'required|min:8',
            'package_cost' => 'required|numeric',
            'package_description' => 'required',
            'subscription_type' => 'required',
            'package_status' => 'required',
            'product_image' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        // Not required (Default: NULL) 
        $valid_data['package_slug'] = strtolower(str_replace(str_split('\\/:*?"<>| '), '-', $request->package_title)) . '-' . uniqid() . rand(100000, 999999);
        $valid_data['package_summary'] = $request->package_summary;     
        $valid_data['duration_hour'] = $request->duration_hour;
        $valid_data['reach_head'] = $request->reach_head;
        $valid_data['print_ad_size'] = $request->print_ad_size;
        $valid_data['billboard_location'] = $request->billboard_location;
        $valid_data['video_length'] = $request->video_length;
 
        if(!empty($request->package_discount_pct))
        {
            $valid_data['package_discount_pct'] = $request->package_discount_pct;
            $valid_data['discount_start_date'] = $request->discount_start_date;
            $valid_data['discount_end_date'] = $request->discount_end_date;
        }else{
            $valid_data['product_discounted_price'] = NULL;
            $valid_data['discount_start_date'] = NULL;
            $valid_data['discount_end_date'] = NULL;
        }

        $pack_obj = Package::findOrFail($id);
        $prevImageName = $pack_obj->package_image;

        if($request->hasFile('package_image') and $request->file('package_image')->isValid())
        {
            $originalImageName = $request->file('package_image')->getClientOriginalName();
            $masterImageName = "PACKAGE_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $valid_data['package_image'] = $masterImageName;
        }

        $pack_obj->update($valid_data);

        if($request->hasFile('package_image') and $request->file('package_image')->isValid())
        {
            $request->package_image->move(public_path('/uploads/packages'), $masterImageName);
            $img_path = public_path('/uploads/packages/' . $prevImageName);
            if(File::exists($img_path))
                File::delete($img_path);
        }
        session()->flash('success', 'Package is Updated Successfully!');
        return redirect()->route('package.show', $id);
    }

    // Delete Package
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package_title = $package->package_title;
        $packageImageName = $package->package_image;
        $img_path = public_path('/uploads/packages/' . $packageImageName);
        $package->delete();
        if(File::exists($img_path))
            File::delete($img_path);
        session()->flash('success', "Package \"$package_title\" has Deleted Successfully...");
        return redirect()->back();
    }
}
