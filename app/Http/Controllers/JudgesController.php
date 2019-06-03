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

        $rank = DB::table('vw_qa_a')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'Contestants','Voice_Quality','Choreography','Costume_Props','Overall_Impact','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getQA(Request $request){
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_qa')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'Contestants','intelligence','outlook','performance','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getFC(Request $request){
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_festivalcostume')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'Contestants','creativity','ethnicity','fitness','confidence','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getCD(Request $request){
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_cocktaildress')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'Contestants','fitness','poise','confidence','beauty','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getSW(Request $request){
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_swimwear')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'Contestants','figure','face','personality','impact','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getMI(Request $request){
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_maranao')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'Contestants','relevance','wearer','personality','elegance','face','TOTAL'])
                    ->get();

        return response()->json($rank);
    }
}
