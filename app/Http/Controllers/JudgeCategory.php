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

    public function CocktailDress(){
        return view('category.cocktaildress');
    }

    public function FestivalCostume(){
        return view('category.festivalcostume');
    }

    public function SwimWear(){
        return view('category.swimwear');
    }

    public function MaranaoInspiredGown(){
        return view('category.inspiredgown');
    }

    public function PreliminaryInterview(){
        return view('category.preliminaryinterview');
    }

    public function QA(){
        return view('category.qa');
    }

}
