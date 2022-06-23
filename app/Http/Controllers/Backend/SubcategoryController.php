<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    // Subcategory List
    public function index()
    {
        $subcategories = Subcategory::latest()->with('category')->get();
        return view('backend.list-subcategory', compact('subcategories'));
    }

    // Add Subcategory
    public function create()
    {
        $categories = Category::orderBy('category_order')->get();
        return view('backend.add-subcategory', compact('categories'));
    }

    // Store Subcategory
    public function store(Request $req)
    {
        $isExist = Subcategory::where([
            ['subcategory_name', $req->subcategory_name], 
            ['category_id', $req->category_id]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The subcategory name has already been taken.']);

        $subcategory = new Subcategory;
        $subcategory->category_id = $req->category_id;
        $subcategory->subcategory_name = $req->subcategory_name;
        $subcategory->subcategory_order = $req->subcategory_order;
        $subcategory->save();
        
        session()->flash('success', 'Subcategory is Created Successfully!');
        return redirect()->route('subcategory.index');
    }

    // Edit Subcategory Page
    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('backend.edit-subcategory', compact('categories', 'subcategory'));
    }

    // Update Subcategory
    public function update(Request $req, $id)
    {
        $isExist = Subcategory::where([
            ['subcategory_name', $req->subcategory_name], 
            ['category_id', $req->category_id],
            ['subcategory_order', $req->subcategory_order]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The subcategory name has already been taken.']);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->category_id = $req->category_id;
        $subcategory->subcategory_name = $req->subcategory_name;
        $subcategory->subcategory_order = $req->subcategory_order;
        $subcategory->save();

        session()->flash('success', 'Subcategory is Updated Successfully!');
        return redirect()->route('subcategory.index');
    }

    // Delete Subcategory
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory_name = $subcategory->subcategory_name;
        $subcategory->delete();
        session()->flash('success', "Subcategory \"$subcategory_name\" has Deleted Successfully...");
        return redirect()->route('subcategory.index');
    }
}
