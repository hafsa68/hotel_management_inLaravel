<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cats = Category::all();
// dd($cats);
        return view('backend.category.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return"kichu nai";
        //dd($request);
         //$request->cat;
$request->validate([
    'cat'=>'required|max:10|min:3|unique:categories,name'
],[
    'required'=>'Category name must be entered',
    'min'=>'Minimum 3 character is required'
    
    //error msg show
]



);

         $data = [
            'name' => $request->cat
         ];
         Category::create($data);
         //Category::insert($category);
         return redirect()->route('category.index')->with('success','Category Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        
$request->validate([
    'cat'=>'required|max:10|min:3|unique:categories,name'
],[
    'required'=>'Category name must be entered',
    'min'=>'Minimum 3 character is required'
    
    //error msg show
]



);




       $data = [

        'name'=> $request->cat
       ];
       $category->update($data);
       return redirect()->route('category.index')->with('success','Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //dd($category);
        //return $category->delete(); 
        $category->delete(); 
        return redirect()->route('category.index')->with('success','Successfully deleted');

    }
}
