<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Rating;
use App\RatingEntry;
use Auth;
use Illuminate\Support\Facades\DB;

class ScoreBoardController extends Controller
{
    public function index(){
        return view('judges.scoreboard');
    }

    public function getScoredCategories(){
        $userid = Auth::user()->id;
        $categories = Category::all();
        //$categories = DB::select('SELECT * from category where id in (SELECT DISTINCT r.categoryid from rating r where r.judgeid=:judgeid)',['judgeid'=>$userid]);
        $data['categories'] = [];

        foreach ($categories as $key => $value) {
            // $ratings = DB::select('SELECT * FROM rating where categoryid=:categoryid and judgeid=:judgeid',['categoryid' => $categories[$key]->id,'judgeid' => $userid]);
            $ratings = Rating::join('contestant','rating.contestantid','=','contestant.id')
                        ->where('categoryid',$categories[$key]->id)
                        ->where('judgeid',$userid)
                        ->get(['rating.*','contestant.name','contestant.cover_image','contestant.number','contestant.age','contestant.representing','contestant.short_description']);

            $categories[$key]['ratings'] = $ratings;
            array_push($data['categories'],$categories[$key]);
        }
        return response()->json($data);
    }

    public function getRatingEntries($id){
        $data['ratingentries'] = RatingEntry::join('criteria','rating_entry.criteriaid','=','criteria.id')
                                    ->where('parentid',$id)
                                    ->get(['rating_entry.*','criteria.criteria_name','criteria.percentage']);
        return response()->json($data);
    }

    public function updateRatings(Request $request)
    {
        $result = $request->payload;
        $rating = $result['rating'];
        $ratingEntries = $result['ratingEntries'];
        $totalScore = $result['totalScore'];

        $tblrating = Rating::find($rating['id']);
        $tblrating->totalrating = $totalScore;
        $save = $tblrating->save();

        foreach ($ratingEntries as $entry) 
        {
            $tblentry = RatingEntry::find($entry['id']);
            $tblentry->acquired_rating = $entry['acquired_rating'];
            $tblentry->save();
        }

        return response()->json($save);
    }

    public function finalizeRating(Request $request){
        $id = $request->id;
        $rating = Rating::find($id);
        $rating->is_final = true;
        $save = $rating->save();

        return response()->json($save);
    }

    public function finalizeRatings(Request $request){
        $uid = Auth::user()->id;
        $id = $request->id;

        $save = Rating::where('judgeid',$uid)
                ->where('categoryid',$id)
                ->update(['is_final' => 1]);

        return response()->json($save);
    }

    public function getRank(){
        $uid = Auth::user()->id;
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));
        // $rank = DB::table('per_judge_ranking')
        //             ->where('Judge',$uid)
        //             ->select([DB::raw('@row := @row + 1 AS seqno'),'Contestants','Interpretation','Choreography','Costume','Sagayan_Beat','Rhythm','TOTAL'])
        //             ->get();

        $rank = DB::table('per_judge_ranking')
                    ->where('Judge',$uid)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'Contestants','Voice_Quality','Choreography','Costume_Props','Overall_Impact','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getCategory(Request $request){
        $userid = Auth::user()->id;
        $categories = Category::where('id',$request->id)->get();
        //$categories = DB::select('SELECT * from category where id in (SELECT DISTINCT r.categoryid from rating r where r.judgeid=:judgeid)',['judgeid'=>$userid]);
        $data['categories'] = [];

        foreach ($categories as $key => $value) {
            // $ratings = DB::select('SELECT * FROM rating where categoryid=:categoryid and judgeid=:judgeid',['categoryid' => $categories[$key]->id,'judgeid' => $userid]);
            $ratings = Rating::join('contestant','rating.contestantid','=','contestant.id')
                        ->where('categoryid',$categories[$key]->id)
                        ->where('judgeid',$userid)
                        ->get(['rating.*','contestant.name','contestant.cover_image','contestant.number','contestant.age','contestant.representing','contestant.short_description']);

            $categories[$key]['ratings'] = $ratings;
            array_push($data['categories'],$categories[$key]);
        }
        return response()->json($data);
    }

    public function getQA(Request $request){
        $uid = Auth::user()->id;
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_QA')
                    ->where('Judge',$uid)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'parent','isFinal','backcolor','Contestants','intelligence','outlook','performance','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getPreliminaryInterview(Request $request){
        $uid = Auth::user()->id;
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_interview')
                    ->where('Judge',$uid)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'backcolor','Contestants','parent','isFinal','outlook','intelligence','performance','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getInspiredGown(Request $request){
        $uid = Auth::user()->id;
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_maranao')
                    ->where('Judge',$uid)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'parent','isFinal','backcolor','Contestants','relevance','wearer','personality','elegance','face','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getSwimWear(Request $request){
        $uid = Auth::user()->id;
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_swimwear')
                    ->where('Judge',$uid)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'parent','isFinal','backcolor','Contestants','figure','face','personality','impact','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getCocktailDress(Request $request){
        $uid = Auth::user()->id;
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_cocktaildress')
                    ->where('Judge',$uid)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'parent','isFinal','backcolor','Contestants','fitness','poise','confidence','beauty','TOTAL'])
                    ->get();

        return response()->json($rank);
    }

    public function getFestivalCostume(Request $request){
        $uid = Auth::user()->id;
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));

        $rank = DB::table('vw_festivalcostume')
                    ->where('Judge',$uid)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'parent','isFinal','backcolor','Contestants','creativity','ethnicity','fitness','confidence','TOTAL'])
                    ->get();

        return response()->json($rank);
    }
}
