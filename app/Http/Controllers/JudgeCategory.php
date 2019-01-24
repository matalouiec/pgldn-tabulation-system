<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JudgeCategory extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        return view('judges.judge-category');
    }
}
