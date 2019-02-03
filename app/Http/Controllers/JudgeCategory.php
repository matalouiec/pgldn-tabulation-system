<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class JudgeCategory extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(isset($request->id)){
            $category = Category::find($request->id);
            if(is_null($category))
            {
                // todo: create error page for unknown routes
            }
            return view('judges.judge-category',['category' => $category]);
        }
    }

}
