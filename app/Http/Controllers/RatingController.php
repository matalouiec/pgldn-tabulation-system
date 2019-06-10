<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Rating;

class RatingController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }
     
     public function toggleRatingState(Request $request){
         $affected = DB::update('UPDATE rating SET is_final =(CASE WHEN is_final != 1 THEN 1 ELSE 0 END) WHERE id =?',[$request->ratingid]);
         if($affected>0){
             return response()->json(true);
         }
         return response()->json(false);
     }
}
