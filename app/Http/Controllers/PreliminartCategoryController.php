<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class PreliminartCategoryController extends Controller
{
    public function index(Request $id){
        return view('judges.judge-category')->with('data',$id);
    }
}
