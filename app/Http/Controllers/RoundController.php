<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Level;
use App\Category;
use App\Contestant;
use App\Rating;
use App\User;

class RoundController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(){
        return view('admin.round.index');
    }

    public function show(){
        $level = Level::all();
         return response()->json($level);
    }

    public function getRoundsWithCategories(){
        $level = Level::all();

        foreach ($level as $key => $value) {
            $categories = Category::where('levelid','=',$level[$key]->id)->get();
            $level[$key]['categories'] = $categories;
        }

        return response()->json($level);
    }

    public function getRankPerCategory(Request $request){
        $rank = Rating::join('contestant','rating.contestantid','=','contestant.id')
                        ->where('rating.categoryid',$request->id)
                        ->where('rating.is_final','1')
                        ->groupBy('rating.contestantid')
                        ->select('contestant.number','contestant.name','contestant.graphcolor',DB::raw('AVG(rating.totalrating) as score'))
                        ->orderBy('score','DESC')
                        ->get();

        return response()->json($rank);
    }

    public function getPercentageStats(Request $request){
        $judge = User::where('is_admin','0')->count();
        $category = Category::where('levelid',$request->id)->count();
        $contestant = Contestant::all()->count();

        $totalRatings = $judge*$category*$contestant;

        $percentage = Rating::join('category','rating.categoryid','=','category.id')
                            ->join('users','rating.judgeid','=','users.id')
                            ->where('category.levelid',$request->id)
                            ->where('rating.is_final','1')
                            ->count();
        
        $result = array(
            'stats' => $percentage,
            'total' => $totalRatings
        );
                            
        return response()->json($result);
    }

    public function getFinalRanking(Request $request){
        $finalrank = DB::table('vw_finalrank')
                        ->where('levelid',$request->id)
                        ->get();
                        
        return response()->json($finalrank);
    }
}
