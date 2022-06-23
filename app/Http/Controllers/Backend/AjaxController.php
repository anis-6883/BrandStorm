<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
}
