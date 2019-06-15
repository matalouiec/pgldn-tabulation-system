<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rank;
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
        $rank = Rank::all();
        return response()->json($rank);
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
}
