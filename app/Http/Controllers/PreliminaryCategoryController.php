<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class PreliminaryCategoryController extends Controller
{
    public function index(Request $id){
        return view('judges.judge-category')->with('data',$id);
    }

    public function festivalcostume(){
        return view('judges.festival-costume');
    }

    public function cocktaildress(){
        return view('judges.cocktail-dress');
    }

    public function swimwear(){
        return view('judges.swim-wear');
    }
    
    public function maranaoinspiredgown(){
        return view('judges.maranao-inspired');
    }

    public function preliminterview(){
        return view('judges.preliminterview');
    }
}
