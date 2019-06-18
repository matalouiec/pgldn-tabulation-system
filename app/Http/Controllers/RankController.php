<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Rank;
use App\Finalist;
use App\Category;
use function GuzzleHttp\json_decode;

class RankController extends Controller
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

    public function index()
    {
        $exclude = Category::where('levelid',1)->first();
        $result = DB::select("SELECT
            CASE
            WHEN @prev_val = y.T THEN
                @count
            WHEN @prev_val := y.T THEN
                @count :=@count + 1
            END AS counter,
            y.*
            FROM
                (
                    SELECT
                        x.id,
                        x.number,
                        x.`name`,
                        x.representing,
                        sum(
                            CASE
                            WHEN x.categoryid = 15 THEN
                                x.rank
                            END
                        )AS pi,
                        sum(
                            CASE
                            WHEN x.categoryid = 16 THEN
                                x.rank
                            END
                        )AS mig,
                        sum(
                            CASE
                            WHEN x.categoryid = 17 THEN
                                x.rank
                            END
                        )AS sw,
                        sum(
                            CASE
                            WHEN x.categoryid = 18 THEN
                                x.rank
                            END
                        )AS cd,
                        sum(
                            CASE
                            WHEN x.categoryid = 19 THEN
                                x.rank
                            END
                        )AS fc,
                        ROUND(sum(x.rank) / 5, 2)AS T
                    FROM
                        (
                            SELECT
                                c.id,
                                c.number,
                                c.`name`,
                                c.representing,
                                r.rank,
                                r.categoryid
                            FROM
                                ranks r
                            INNER JOIN contestant c ON r.contestantid = c.id
                            WHERE r.categoryid!=$exclude->id
                        )AS x
                    GROUP BY
                        x.id
                    ORDER BY
                        T ASC
                )AS y,
                (
                    SELECT
                        @prev_val := ' ' ,@count := 0
                ) as tmp");

        return response()->json($result);
    }

    public function save(Request $rank)
    {
        $data = $rank->payload;
        if (isset($data)) {
            foreach ($data as $d) {
                $row = Rank::where('categoryid', $d['categoryid'])->where('contestantid', $d['contestantid'])->count();
                if ($row > 0) {
                    $r = Rank::where('categoryid', $d['categoryid'])->where('contestantid', $d['contestantid'])->first();
                    $r->rank = $d['counter'];
                    $r->save();
                } else {
                    $r = new Rank();
                    $r->categoryid = $d['categoryid'];
                    $r->contestantid = $d['contestantid'];
                    $r->rank = $d['counter'];
                    $r->save();
                }
            }
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function saveFinalist(Request $candidates)
    {
        $data = $candidates->payload;
        try {
            Finalist::truncate();
            foreach ($data as $d) {
                $f = new Finalist;
                $f->contestantid = $d['id'];
                $f->save();
            }
            return response()->json(['code' => 201]);
        } catch (Exception $e) {
            return response()->json(['code' => 500]);
        }
    }
}
