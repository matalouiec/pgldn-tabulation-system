<?php

namespace App\Http\Controllers;

use App\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'criteria_name' => 'required',
            'percentage' => 'required|numeric'
        ]);

        $count = $this->checkTotalPercentage($request->category_id);
        $left = 100 - $count;
        $count = $count + $request->percentage;

        if($count>100){
            $data['message'] = "Total percentage exceeds 100%. You only need ".$left.".";
            $data['left'] = $left;
            $data['status'] = false;
        }else{
            $criteria = new Criteria;
            $criteria->category_id = $request->category_id;
            $criteria->criteria_name = $request->criteria_name;
            $criteria->percentage = $request->percentage;
            $criteria->subcategoryid = $request->subcategoryid;
            $criteria->save();

            $data['message'] = "New criteria successfully added.";
            $data['status'] = true;
        }

        echo json_encode($data);
    }

    private function checkTotalPercentage($categoryId){
        return DB::table('criteria')->where('category_id','=',$categoryId)->sum('percentage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criteria $criteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criteria)
    {
        //
    }
}
