<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndividualRankReport(Request $request){
        $id = $request->id;
        $judge = User::find($id);

        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));
        $rank = DB::table('vw_qa')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'isFinal','parent','backcolor','judge','Contestants','intelligence','outlook','performance','TOTAL'])
                    ->get();

        $payload = array(
            'judge' => $judge,
            'rank'  => $rank
        );
        
        return view('reports.judges.individualrank')->with('data',$payload);
    }

    public function getFinalReport(Request $request){  //controller for printable result
        $routeURL = "";
        $judges = User::where('is_admin',0)
                        ->where('id','<>',4)
                        ->orderBy('id')
                        ->get();
        $chairman = User::find(4);
        // $rank = DB::select("SELECT
        //             CASE WHEN @prev_val = y.T THEN @count
        //                                 WHEN @prev_val:=y.T THEN @count:=@count+1
        //                                 END as counter,
        //             y.*
        //         FROM (
        //             SELECT
        //                 xxx.Contestants,
        //                 SUM(CASE WHEN xxx.Judges=1 THEN xxx.row_number END) as `Judge1`,
        //                 SUM(CASE WHEN xxx.Judges=3 THEN xxx.row_number END) as `Judge2`,
        //                 SUM(CASE WHEN xxx.Judges=4 THEN xxx.row_number END) as `Judge3`,
        //                 SUM(CASE WHEN xxx.Judges=5 THEN xxx.row_number END) as `Judge4`,
        //                 SUM(CASE WHEN xxx.Judges=6 THEN xxx.row_number END) as `Judge5`,
        //                 SUM(xxx.row_number) as `T`
        //             FROM
        //                 (
        //                         SELECT
        //                             xx.Contestants,
        //                             xx.TOTAL,
        //                             @row_number := CASE
        //                         WHEN @judge = xx.Judge THEN
        //                             (
        //                                 CASE
        //                                 WHEN @prev_value = xx.TOTAL THEN
        //                                     @row_number
        //                                 WHEN @prev_value := xx.TOTAL THEN
        //                                     @row_number + 1
        //                                 END
        //                             )
        //                         ELSE
        //                             1
        //                         END AS row_number,
        //                         @judge := xx.Judge AS Judges,
        //                         @prev_value := xx.TOTAL AS xxTOTAL,
        //                         CASE
        //                             WHEN xx.Judge = 1 THEN
        //                                 @row_number
        //                             END AS `Judge_1`,
        //                             CASE
        //                         WHEN xx.Judge = 3 THEN
        //                             @row_number
        //                         END AS `Judge_2`,
        //                         CASE
        //                         WHEN xx.Judge = 4 THEN
        //                             @row_number
        //                         END AS `Judge_3`,
        //                         CASE
        //                         WHEN xx.Judge = 5 THEN
        //                             @row_number
        //                         END AS `Judge_4`,
        //                         CASE
        //                         WHEN xx.Judge = 6 THEN
        //                             @row_number
        //                         END AS `Judge_5`
        //                         FROM
        //                             per_judge_qa AS xx,
        //                             (
        //                                 SELECT
        //                                     @row_number := 0 ,@judge := '' ,@prev_value := ''
        //                             )AS t
        //                         ORDER BY
        //                             xx.Judge,
        //                             xx.TOTAL DESC
        //                 )AS xxx
        //             GROUP BY
        //                 xxx.Contestants
        //             ORDER BY
        //                 T ASC
        //         ) as y,
        //         (SELECT @prev_val:='',@count:=0) as tmp");

            $payload = array(
                'judges' => $judges,
                // 'rank' => $rank,
                'chairman' => $chairman
            );

            switch ($request->vwname) {
                case 'vw_qa':
                    $routeURL = "reports.admin.finalrankresult";
                    break;
                
                case 'vw_festivalcostume':
                    $routeURL = "reports.admin.festivalcostume";
                    break;

                case 'vw_cocktaildress':
                    $routeURL = "reports.admin.cocktaildress";
                    break;

                case 'vw_swimwear':
                    $routeURL = "reports.admin.swimwear";
                    break;

                case 'vw_maranao':
                    $routeURL = "reports.admin.maranao";
                    break;

                case 'vw_interview':
                    $routeURL = "reports.admin.interview";
                    break;

                default:
                    # code...
                    break;
            }

            return view($routeURL)->with('data',$payload);
    }

    public function getFinalRankReport(Request $request){
        $vw_name = $request->vwname; // request view name

        $rank = DB::select("SELECT
                    CASE WHEN @prev_val = y.T THEN @count
                                        WHEN @prev_val:=y.T THEN @count:=@count+1
                                        END as counter,
                    y.*
                FROM (
                    SELECT
                        xxx.Contestants,
                        SUM(CASE WHEN xxx.Judges=1 THEN xxx.row_number END) as `Judge1`,
                        SUM(CASE WHEN xxx.Judges=3 THEN xxx.row_number END) as `Judge2`,
                        SUM(CASE WHEN xxx.Judges=4 THEN xxx.row_number END) as `Judge3`,
                        SUM(CASE WHEN xxx.Judges=5 THEN xxx.row_number END) as `Judge4`,
                        SUM(CASE WHEN xxx.Judges=6 THEN xxx.row_number END) as `Judge5`,
                        SUM(xxx.row_number) as `T`
                    FROM
                        (
                                SELECT
                                    xx.Contestants,
                                    xx.TOTAL,
                                    @row_number := CASE
                                WHEN @judge = xx.Judge THEN
                                    (
                                        CASE
                                        WHEN @prev_value = xx.TOTAL THEN
                                            @row_number
                                        WHEN @prev_value := xx.TOTAL THEN
                                            @row_number + 1
                                        END
                                    )
                                ELSE
                                    1
                                END AS row_number,
                                @judge := xx.Judge AS Judges,
                                @prev_value := xx.TOTAL AS xxTOTAL,
                                CASE
                                    WHEN xx.Judge = 1 THEN
                                        @row_number
                                    END AS `Judge_1`,
                                    CASE
                                WHEN xx.Judge = 3 THEN
                                    @row_number
                                END AS `Judge_2`,
                                CASE
                                WHEN xx.Judge = 4 THEN
                                    @row_number
                                END AS `Judge_3`,
                                CASE
                                WHEN xx.Judge = 5 THEN
                                    @row_number
                                END AS `Judge_4`,
                                CASE
                                WHEN xx.Judge = 6 THEN
                                    @row_number
                                END AS `Judge_5`
                                FROM
                                    $vw_name AS xx,
                                    (
                                        SELECT
                                            @row_number := 0 ,@judge := '' ,@prev_value := ''
                                    )AS t
                                ORDER BY
                                    xx.Judge,
                                    xx.TOTAL DESC
                        )AS xxx
                    GROUP BY
                        xxx.Contestants
                    ORDER BY
                        T ASC
                ) as y,
                (SELECT @prev_val:='',@count:=0) as tmp");

        return response()->json($rank);
    }

    public function getIndividualRankReportQA(Request $request){
        $id = $request->id;
        $judge = User::find($id);

        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));
        $rank = DB::table('vw_qa')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'isFinal','parent','backcolor','judge','Contestants','intelligence','outlook','performance','TOTAL'])
                    ->get();

        $payload = array(
            'judge' => $judge,
            'rank'  => $rank,
            'category' => 'Question and Answer'
        );
        
        return view('reports.judges.individualrank')->with('data',$payload);
    }
    public function getIndividualRankReportFC(Request $request){
        $id = $request->id;
        $judge = User::find($id);
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));
        $rank = DB::table('vw_festivalcostume')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'isFinal','parent','backcolor','judge','Contestants','creativity','ethnicity','fitness','confidence','TOTAL'])
                    ->get();

        $payload = array(
            'judge' => $judge,
            'rank'  => $rank,
            'category' => 'Festival Costume'
        );
        
        return view('reports.judges.individualrankfc')->with('data',$payload);
    }

    public function getIndividualRankReportCD(Request $request){
        $id = $request->id;
        $judge = User::find($id);
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));
        $rank = DB::table('vw_cocktaildress')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'isFinal','parent','backcolor','judge','Contestants','fitness','poise','confidence','beauty','TOTAL'])
                    ->get();

        $payload = array(
            'judge' => $judge,
            'rank'  => $rank,
            'category' => 'Cocktail Dress'
        );
        
        return view('reports.judges.individualrankcd')->with('data',$payload);
    }

    public function getIndividualRankReportSW(Request $request){
        $id = $request->id;
        $judge = User::find($id);
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));
        $rank = DB::table('vw_swimwear')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'isFinal','parent','backcolor','judge','Contestants','figure','face','personality','impact','TOTAL'])
                    ->get();

        $payload = array(
            'judge' => $judge,
            'rank'  => $rank,
            'category' => 'Swim Wear'
        );
        
        return view('reports.judges.individualranksw')->with('data',$payload);
    }

    public function getIndividualRankReportMI(Request $request){
        $id = $request->id;
        $judge = User::find($id);
        DB::statement(DB::raw('set @prev_value:=NULL'));
        DB::statement(DB::raw('set @row:=0'));
        $rank = DB::table('vw_maranao')
                    ->where('Judge',$request->id)
                    ->select([DB::raw('CASE WHEN @prev_value = TOTAL THEN @row
                                        WHEN @prev_value := TOTAL THEN @row := @row + 1
                                        END AS seqno'),'isFinal','parent','backcolor','judge','Contestants','relevance','wearer','personality','elegance','face','TOTAL'])
                    ->get();

        $payload = array(
            'judge' => $judge,
            'rank'  => $rank,
            'category' => 'Maranao Inspired Gown'
        );
        
        return view('reports.judges.individualrankmi')->with('data',$payload);
    }

    // ---------------- Final Rank per Category
    public function getFinalRankFestivalCostume(){
        $rank = DB::select("SELECT
                    CASE WHEN @prev_val = y.T THEN @count
                                        WHEN @prev_val:=y.T THEN @count:=@count+1
                                        END as counter,
                    y.*
                FROM (
                    SELECT
                        xxx.Contestants,
                        SUM(CASE WHEN xxx.Judges=1 THEN xxx.row_number END) as `Judge1`,
                        SUM(CASE WHEN xxx.Judges=3 THEN xxx.row_number END) as `Judge2`,
                        SUM(CASE WHEN xxx.Judges=4 THEN xxx.row_number END) as `Judge3`,
                        SUM(CASE WHEN xxx.Judges=5 THEN xxx.row_number END) as `Judge4`,
                        SUM(CASE WHEN xxx.Judges=6 THEN xxx.row_number END) as `Judge5`,
                        SUM(xxx.row_number) as `T`
                    FROM
                        (
                                SELECT
                                    xx.Contestants,
                                    xx.TOTAL,
                                    @row_number := CASE
                                WHEN @judge = xx.Judge THEN
                                    (
                                        CASE
                                        WHEN @prev_value = xx.TOTAL THEN
                                            @row_number
                                        WHEN @prev_value := xx.TOTAL THEN
                                            @row_number + 1
                                        END
                                    )
                                ELSE
                                    1
                                END AS row_number,
                                @judge := xx.Judge AS Judges,
                                @prev_value := xx.TOTAL AS xxTOTAL,
                                CASE
                                    WHEN xx.Judge = 1 THEN
                                        @row_number
                                    END AS `Judge_1`,
                                    CASE
                                WHEN xx.Judge = 3 THEN
                                    @row_number
                                END AS `Judge_2`,
                                CASE
                                WHEN xx.Judge = 4 THEN
                                    @row_number
                                END AS `Judge_3`,
                                CASE
                                WHEN xx.Judge = 5 THEN
                                    @row_number
                                END AS `Judge_4`,
                                CASE
                                WHEN xx.Judge = 6 THEN
                                    @row_number
                                END AS `Judge_5`
                                FROM
                                    vw_festivalcostume AS xx,
                                    (
                                        SELECT
                                            @row_number := 0 ,@judge := '' ,@prev_value := ''
                                    )AS t
                                ORDER BY
                                    xx.Judge,
                                    xx.TOTAL DESC
                        )AS xxx
                    GROUP BY
                        xxx.Contestants
                    ORDER BY
                        T ASC
                ) as y,
                (SELECT @prev_val:='',@count:=0) as tmp");
        return response()->json($rank);
    }
    // End final rank per category

    // Final Rank
    public function getFinalReportFC(){  //controller for printable result
        $judges = User::where('is_admin',0)
                        ->where('id','<>',4)
                        ->orderBy('id')
                        ->get();

        $chairman = User::find(4);

        $rank = DB::select("SELECT
                    CASE WHEN @prev_val = y.T THEN @count
                                        WHEN @prev_val:=y.T THEN @count:=@count+1
                                        END as counter,
                    y.*
                FROM (
                    SELECT
                        xxx.Contestants,
                        SUM(CASE WHEN xxx.Judges=1 THEN xxx.row_number END) as `Judge1`,
                        SUM(CASE WHEN xxx.Judges=3 THEN xxx.row_number END) as `Judge2`,
                        SUM(CASE WHEN xxx.Judges=4 THEN xxx.row_number END) as `Judge3`,
                        SUM(CASE WHEN xxx.Judges=5 THEN xxx.row_number END) as `Judge4`,
                        SUM(CASE WHEN xxx.Judges=6 THEN xxx.row_number END) as `Judge5`,
                        SUM(xxx.row_number) as `T`
                    FROM
                        (
                                SELECT
                                    xx.Contestants,
                                    xx.TOTAL,
                                    @row_number := CASE
                                WHEN @judge = xx.Judge THEN
                                    (
                                        CASE
                                        WHEN @prev_value = xx.TOTAL THEN
                                            @row_number
                                        WHEN @prev_value := xx.TOTAL THEN
                                            @row_number + 1
                                        END
                                    )
                                ELSE
                                    1
                                END AS row_number,
                                @judge := xx.Judge AS Judges,
                                @prev_value := xx.TOTAL AS xxTOTAL,
                                CASE
                                    WHEN xx.Judge = 1 THEN
                                        @row_number
                                    END AS `Judge_1`,
                                    CASE
                                WHEN xx.Judge = 3 THEN
                                    @row_number
                                END AS `Judge_2`,
                                CASE
                                WHEN xx.Judge = 4 THEN
                                    @row_number
                                END AS `Judge_3`,
                                CASE
                                WHEN xx.Judge = 5 THEN
                                    @row_number
                                END AS `Judge_4`,
                                CASE
                                WHEN xx.Judge = 6 THEN
                                    @row_number
                                END AS `Judge_5`
                                FROM
                                    per_judge_ranking AS xx,
                                    (
                                        SELECT
                                            @row_number := 0 ,@judge := '' ,@prev_value := ''
                                    )AS t
                                ORDER BY
                                    xx.Judge,
                                    xx.TOTAL DESC
                        )AS xxx
                    GROUP BY
                        xxx.Contestants
                    ORDER BY
                        T ASC
                ) as y,
                (SELECT @prev_val:='',@count:=0) as tmp");

            $payload = array(
                'judges' => $judges,
                'rank' => $rank,
                'chairman' => $chairman
            );

            return view('reports.admin.festivalcostume')->with('data',$payload);
    }
    // End Final Rank
}
