<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class JudgesController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getJudges(){
        $judges = User::where('is_admin','0')->get();
        return response()->json($judges);
    }

    public function getIndividualRank(Request $request){
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('per_judge_ranking')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'Contestants','Voice_Quality','Choreography','Costume_Props','Overall_Impact','TOTAL'])
                    ->get();

        return response()->json($rank);
    }
}
