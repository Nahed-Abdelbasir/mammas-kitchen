<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator=\Validator::make($request->all(),
                                   [
                'name'=>'required|max:191|min:3',             
                                   ]);
        

        if ($validator->fails()) {
            return redirect()->route('category.create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $category = new Category();

        $category->name = $request->name ;
        $category->slug = str_slug($request->name) ;
        $category->save();

        return redirect()->route('category.index')->with('successMsg',"Category Successfully Created !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('admin.category.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator=\Validator::make($request->all(),
                    [
            'name'=>'required|max:191|min:3',             
                    ]);

        $category = Category::find($id);

        if ($validator->fails()) {
        return redirect()->route('category.edit', $category->id )
        ->withErrors($validator)
        ->withInput();
        }


        $category->name = $request->name ;
        $category->slug = str_slug($request->name) ;
        $category->save();

        return redirect()->route('category.index')->with('successMsg',"Category Successfully Updated !");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with('successMsg',"Category Successfully Deleted !");
    }
}
