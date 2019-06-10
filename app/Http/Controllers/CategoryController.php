<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Category;
use App\SubCategory;
use App\Level;
use App\Criteria;
use App\Rating;
use Illuminate\Http\Request;
use Response;
use View;

class CategoryController extends Controller
{
       //
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::join('levels','category.levelid','=','levels.id')
                                ->get(['category.id','category.name AS catname','category.description','category.is_active','category.percentage','levels.name AS levelname']);
        return view('admin.category.home')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $level = Level::pluck('name','id');
        return view('admin.category.create')->with('level',$level);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = Category::find($category->id);
        $subcategory = SubCategory::pluck('name','id');
        $criteria = Category::find($category->id)
                    ->criterias;

        $data = array(
            'category' => $category,
            'subcategory' => $subcategory,
            'criterias' => $criteria
        );

        return view('admin.category.criteria')->with('data',$data);
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
            'name' => 'required',
            'description' => 'required'
        ]);

        $isActive = $request->input('is_active');
        if($isActive!=1){
            $isActive = 0;
        }

        $category = new Category;
        $category->name = $request->input('name');
        $category->levelid = $request->input('level');
        $category->percentage = $request->input('percentage');
        $category->description = $request->input('description');
        $category->is_active = $isActive;
        $category->save();

        return redirect('/category')->with('success','New category created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $level = Level::pluck('name','id');

        return view('admin.category.edit')
                 ->with('category',$category)
                 ->with('level',$level);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    // PUT request to route /category
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);
        
        $isActive = $request->input('is_active');
        if($isActive!=1){
            $isActive = 0;
        }else{
            $isActive = 1;
        }


        $category = Category::find($category->id);
        $category->name = $request->input('name');
        $category->levelid = $request->input('level');
        $category->percentage = $request->input('percentage');
        $category->description = $request->input('description');
        $category->is_active = $isActive;
        $category->save();

        return redirect('/category')->with('success','Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::find($category->id);
        if($category!=null){
            $criteria = Criteria::where('category_id',$category->id)->delete();
            if($criteria){
                $category->delete();
            }
            $category->delete();
        }

        return redirect('/category')->with('success','Successfuly deleted');
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function getCriterias(Category $category)
    {
        $criterias = Category::find($category->id)->criterias;
        return $criterias;
    }

    public function getCategoriesByJudgeId(Request $request){
        $data['categories'] = [];
        $categories = Rating::join('category','category.id','=','rating.categoryid')
                        ->select('category.id','category.name',DB::raw('count(rating.contestantid)AS counter'))
                        ->where('rating.judgeid',$request->id)
                        ->groupBy('category.id')
                        ->get();

        foreach($categories as $key => $value){
            $ratings = Rating::join('contestant','contestant.id','=','rating.contestantid')
                                ->where('categoryid',$categories[$key]->id)
                                ->where('rating.judgeid',$request->id)
                                ->get(["rating.id","rating.is_final","rating.totalrating","contestant.number","contestant.name","contestant.cover_image"]);

            $categories[$key]['ratings'] = $ratings;
            array_push($data['categories'],$categories[$key]);
        }

        return response()->json($data);
    }
}
