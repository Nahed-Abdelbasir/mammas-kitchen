<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Slider;
use App\Contact;
use App\Category;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoryCount= Category::count();
        $itemCount= Item::count();
        $sliderCount= Slider::count();
        $reservations= Reservation::where('status', 'false')->get();
        $contactCount= Contact::count();
        return view('admin.dashboard' , 
                    compact('categoryCount','itemCount','sliderCount','reservations','contactCount' ));
    }

   

}
