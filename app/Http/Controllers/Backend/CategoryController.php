<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Category List
    public function index()
    {
        $categories = Category::all();
        return view('backend.list-category', compact('categories'));
    }

    // Add Category Page
    public function create()
    {
        return view('backend.add-category');
    }

    // Store Category
    public function store(Request $req)
    {
        $req->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);
        
        $cat_obj = new Category;
        $cat_obj->category_name = $req->category_name;
        $cat_obj->category_order = $req->category_order;
        $cat_obj->save();

        session()->flash('success', 'Category is Created Successfully!');
        return redirect()->route('category.index');
    }

    // Edit Category Page
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.edit-category', compact('category'));
    }

    // Update Category
    public function update(Request $req, $id)
    {
        $category = Category::findOrFail($id);

        $isExist = Category::where([
            ['category_name', $req->category_name], 
            ['category_order', $req->category_order]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The category name has already been taken.']);

        $category->category_name = $req->category_name;
        $category->category_order = $req->category_order;
        $category->save();

        session()->flash('success', 'Category is Updated Successfully!');
        return redirect()->route('category.index');
    }

    // Delete Category
    public function destroy($id)
    {
        $category = Category::find($id);
        $category_name = $category->category_name;
        $category->delete();
        session()->flash('success', "Category \"$category_name\" has Deleted Successfully...");
        return redirect()->back();
    }
}
