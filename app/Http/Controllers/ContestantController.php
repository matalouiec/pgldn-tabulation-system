<?php

namespace App\Http\Controllers;

use App\Contestant;
use Illuminate\Http\Request;

class ContestantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contestants = Contestant::all();
        return view('admin.contestant.index')->with('contestants',$contestants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contestant.create');
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
            'number' => 'required|numeric|unique:contestant',
            'name' => 'required',
            'representing' => 'required',
            'short_description' => 'required',
            'age' => 'required|numeric',
            'cover_image' => 'image|max:1999'
        ]);

        if($request->hasFile('cover_image'))
        {
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $request->input('number').'_'.time().'.'.$extension;

            $path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'NoImage.jpg';
        }

        $contestant = new Contestant;
        $contestant->number = $request->input('number');
        $contestant->name = $request->input('name');
        $contestant->representing = $request->input('representing');
        $contestant->short_description = $request->input('short_description');
        $contestant->age = $request->input('age');
        $contestant->cover_image = $fileNameToStore;
        $contestant->save();

        return redirect('/contestant')->with('success','Contestant added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contestant  $contestant
     * @return \Illuminate\Http\Response
     */
    public function show(Contestant $contestant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contestant  $contestant
     * @return \Illuminate\Http\Response
     */
    public function edit(Contestant $contestant)
    {
        $contestant = Contestant::find($contestant->id);
        return view('admin.contestant.edit')->with('contestant',$contestant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contestant  $contestant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contestant $contestant)
    {
        $row = Contestant::find($contestant->id);
        $row->number = $request->number;
        $row->age = $request->age;
        $row->name = $request->name;
        $row->representing = $request->representing;
        $row->short_description=$request->short_description;
        $row->update();

        return redirect('/contestant')->with('success','Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contestant  $contestant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contestant $contestant)
    {
        //
    }

    public function contestantSelection(){
        return view('admin.contestant.contestantselection');
    }

    public function getAllContestants(){
        $contestants = Contestant::all();
        return response()->json($contestants);
    }
}
