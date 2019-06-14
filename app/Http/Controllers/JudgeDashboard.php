<?php

namespace App\Http\Controllers;

use App\Category;
use App\Criteria;
use App\Contestant;
use App\Rating;
use App\RatingEntry;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JudgeDashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('judges.dashboard');
    }

    public function getActiveCategory(){
        $userid = Auth::id();
        $categories = Category::where('is_active',1)->where('levelid',3)->get();
        $data['categories'] = [];

        foreach ($categories as $key => $value) {
            $contestant = DB::select('SELECT c.* from contestant c where c.id not in (SELECT r.contestantid FROM rating r WHERE r.judgeid =:judgeid AND r.categoryid =:categoryid)',['judgeid' => $userid,'categoryid' => $categories[$key]->id]);
            $categories[$key]['contestants'] = $contestant;
            array_push($data['categories'],$categories[$key]);
        }
        return response()->json($data);
    }

    public function getActiveFinalCategory(){
        $userid = Auth::id();
        $categories = Category::where('is_active',1)->where('levelid',1)->get();
        $data['categories'] = [];

        foreach ($categories as $key => $value) {
            $contestant = DB::select('SELECT c.* from contestant c where c.id not in (SELECT r.contestantid FROM rating r WHERE r.judgeid =:judgeid AND r.categoryid =:categoryid) and c.id in (SELECT f.contestantid from finalist f)',['judgeid' => $userid,'categoryid' => $categories[$key]->id]);
            $categories[$key]['contestants'] = $contestant;
            array_push($data['categories'],$categories[$key]);
        }
        return response()->json($data);
    }

    public function show(Category $category){
        $category = Category::find($category->id);
        $criterias = Category::find($category->id)->criterias;
        $contestants = Contestant::all();
        
        $data = array(
            'category' => $category,
            'criterias' => $criterias,
            'contestants' => $contestants
        );

        return view('judges.category')->with('data',$data);
    }

    public function getCriteria(Category $category){
        $data['criterias'] = Category::find($category->id)->criterias;
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function createRatingHeader(Request $request){
        $userid = Auth::user()->id;
        $result = $request->payload;
        $category = $result['category'];
        $contestant = $result['contestant'];
        //$score = $result['score'];
        $totalScore = $result['totalScore'];

        $count = Rating::where('judgeid',$userid)
                            ->where('contestantid',$contestant['id'])
                            ->where('categoryid',$category['id'])
                            ->count();
        if($count == 0)
        {
            $rating = new Rating;
            $rating->judgeid = $userid;
            $rating->categoryid = $category['id'];
            $rating->contestantid = $contestant['id'];
            $rating->totalrating = $totalScore;
            $rating->save();

            $data['id'] = $rating->id; //return the id of the last inserted data
        }
        else
        {
            $rating = Rating::where('judgeid',$userid)
                            ->where('contestantid',$contestant['id'])
                            ->where('categoryid',$category['id'])
                            ->first();

            $row = Rating::find($rating->id);
            $row->totalrating = $totalScore;
            $row->save();
            
            $data['id'] = $rating->id;
        }

        $this->saveRatingEntries($result,$data); // saving scores to the database
        return response()->json($data);
    }

    private function saveRatingEntries(array $payload,array $headerId)
    {
        $userid = Auth::user()->id;
        $category = $payload['category'];
        $contestant = $payload['contestant'];
        $scores = $payload['score'];
        
        $count = RatingEntry::where('parentid',$headerId['id'])
                            ->where('judgeid',$userid)
                            ->where('categoryid',$category['id'])
                            ->count();

        if($count==0)
        {
            foreach ($scores as $score) 
            {
                $entry = new RatingEntry;
                $entry->parentid = $headerId['id'];
                $entry->judgeid = $userid;
                $entry->categoryid = $category['id'];
                $entry->criteriaid = $score['criteriaid'];
                $entry->contestantid = $contestant['id'];
                $entry->acquired_rating = $score['value'];
                $entry->save();
            }
        }
    }
}
