<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // Category Status Update
    public function categoryUpdateStatus(Request $req)
    {
        try{
            $category = Category::findOrFail($req->category_id);
            $category->category_status = $req->statusText;
            if($category->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    // Subcategory Status Update
    public function subcategoryUpdateStatus(Request $req)
    {
        try{
            $subcategory = Subcategory::findOrFail($req->subcategory_id);
            $subcategory->subcategory_status = $req->statusText;
            if($subcategory->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    // Package Status Update
    public function packageUpdateStatus(Request $req)
    {
        try{
            $package = Package::findOrFail($req->package_id);
            $package->package_status = $req->statusText;
            if($package->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    // Load Subcategory
    public function loadSubcategory(Request $req)
    {
        try
        {
            $subcategories = Subcategory::where('category_id', $req->category_id)->get();

            if(count($subcategories) > 0)
            {
                // echo "<option value=''>Select Subcategory</option>";

                foreach($subcategories as $subcategory)
                {
                    echo '<option value="'. $subcategory->id . '">' . $subcategory->subcategory_name .'</option>';
                }
            }
            else
                echo "<option value=''>No Subcategory Found</option>";
        }
        catch(Exception $e)
        {
            return 0;
        } 
    }

    // Load Seleted Subcategory
    public function loadSeletedSubcategory(Request $req)
    {
        try
        {
            $subcategories = Subcategory::where('category_id', $req->category_id)->get();

            if(!empty($subcategories))
                foreach($subcategories as $subcategory)
                {
                    echo '<option value="'. $subcategory->id . '"';
                    
                        if($subcategory->id == $req->subcategory_id) echo "selected";
                    
                    echo '>' . $subcategory->subcategory_name .'</option>';
                }
            else
                return 0;
        }
        catch(Exception $e)
        {
            return 0;
        } 
    }

}
