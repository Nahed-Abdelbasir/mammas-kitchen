<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::all();
        return view('admin.slider.index' , compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.slider.create');
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
                'title'=>'required|max:191|min:5',
                'sub_title'=>'required|max:191|min:3',
                'image'=>'required|image|max:10240'                       
                                   ]);
        

        if ($validator->fails()) {
            return redirect()->route('slider.create')
                        ->withErrors($validator)
                        ->withInput();
        }
  
        $image=$request->file('image');

        if(isset($image)){
            $imageName = time().$image->getClientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);

            if(!file_exists(public_path().'/uploads/sliders')){
                mkdir(public_path().'/uploads/sliders' , 0777 , true);
            }

            $img->save(public_path().'/uploads/sliders/'.$imageName);
            
        }else{
            $imageName = "default.jpg";
        }
       

        $slider = new Slider();

        $slider->title = $request->title ;
        $slider->sub_title = $request->sub_title ;
        $slider->image = $imageName ;
        $slider->save();

        return redirect()->route('slider.index')->with('successMsg',"Slider Successfully Created !");
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
        $slider = Slider::find($id);
        
        return view('admin.slider.edit' , compact('slider'));
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
                'title'=>'required|max:191|min:5',
                'sub_title'=>'required|max:191|min:3',
                'image'=>'image|max:10240'                       
                                   ]);
        
        
        $image=$request->file('image');

        $slider = Slider::find($id);

        if ($validator->fails()) {
            return redirect()->route('slider.edit' , $slider->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        if(isset($image)){

            $imageName = time().$image->getClientOriginalName();
            $img = \Image::make($image->getRealPath());
            $img->resize(350, 350);

             if(file_exists(public_path().'/uploads/sliders/'.$slider->image) && $slider->image != 'default.jpg'){
                unlink(public_path().'/uploads/sliders/'.$slider->image);
            }

            $img->save(public_path().'/uploads/sliders/'.$imageName);
        
        }else{
            $imageName = $slider->image ;
        }


        $slider->title = $request->title ;
        $slider->sub_title = $request->sub_title ;
        $slider->image = $imageName ;
        $slider->save();

        return redirect()->route('slider.index')->with('successMsg',"Slider Successfully Updated !");

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
        $slider = Slider::find($id);
        if(file_exists(public_path().'/uploads/sliders/'.$slider->image) && $slider->image != 'default.jpg')
        {
            unlink(public_path().'/uploads/sliders/'.$slider->image);
        }
        $slider->delete();

        return redirect()->back()->with('successMsg',"Slider Successfully Deleted !");

    }
    
}
