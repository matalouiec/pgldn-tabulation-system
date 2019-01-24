<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate as Gate;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        if (Gate::allows('admin-only', Auth::user())) {
            return view('dashboard.home');
        }else{
            return redirect('judge-dashboard');
        }
    }
}
