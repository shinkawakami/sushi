<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;

class PrefectureController extends Controller
{
    /*public function index(Category $category)
    {
        return view('categories.index')->with(['posts' => $category->getByCategory(), 'category_name' => $category->name]);
    }
    */
    public function index(Prefecture $prefecture){
        return view('categories.index')->with(['posts' => $prefecture->getByCategory(), 'category_name' => $prefecture->name]);
    }
    
}