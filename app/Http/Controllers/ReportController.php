<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

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

    public function getFinalReport(){  //controller for printable result
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

            return view('reports.admin.finalrankresult')->with('data',$payload);
    }

    public function getFinalRankReport(){
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
                                    vw_qa AS xx,
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
}
