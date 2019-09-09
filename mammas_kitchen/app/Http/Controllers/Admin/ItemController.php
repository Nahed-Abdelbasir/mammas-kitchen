<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Item::all();
        return view('admin.item.index' , compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.item.create' , compact('categories'));
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
            'category'=>'required',
            'name'=>'required|max:191|min:3',
            'description'=>'required|min:5',
            'price'=>'required',
            'image'=>'required|image|max:10240'                       
                    ]);


        if ($validator->fails()) {
        return redirect()->route('item.create')
        ->withErrors($validator)
        ->withInput();
        }

        $image=$request->file('image');

        if(isset($image)){
            $imageName = time().$image->getClientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);

            if(!file_exists(public_path().'/uploads/items')){
                mkdir(public_path().'/uploads/items' , 0777 , true);
            }
            $img->save(public_path().'/uploads/items/'.$imageName);

        }else{
            $imageName = "default.jpg";
        }


        $item = new item();
         
        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imageName;
        $item->save();

        return redirect()->route('item.index')->with('successMsg',"Item Successfully Created !");

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
        $item = Item::find($id);
        $categories = Category::all();
        return view('admin.item.edit' , compact('categories' , 'item'));
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
                'category'=>'required',
                'name'=>'required|max:191|min:3',
                'description'=>'required|min:5',
                'price'=>'required',
                'image'=>'image|max:10240'                       
                        ]);


        $image=$request->file('image');

        $item = Item::find($id);


        if ($validator->fails()) {
        return redirect()->route('item.edit' , $item->id )
        ->withErrors($validator)
        ->withInput();
        }


        if(isset($image)){
            $imageName = time().$image->getClientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);

            if(file_exists(public_path().'/uploads/items/'.$item->image) && $item->image != 'default.jpg'){
                unlink(public_path().'/uploads/items/'.$item->image);
            }
            

            $img->save(public_path().'/uploads/items/'.$imageName);

        }else{
            $imageName = $item->image;
        }

        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imageName;
        $item->save();

        return redirect()->route('item.index')->with('successMsg',"Item Successfully Updated !");


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
        $item = Item::find($id);
        if(file_exists(public_path().'/uploads/items/'.$item->image) && $item->image != 'default.jpg'){
            unlink(public_path().'/uploads/items/'.$item->image);
        }
        $item->delete();

        return redirect()->back()->with('successMsg',"Item Successfully Deleted !");
        
    }
}
