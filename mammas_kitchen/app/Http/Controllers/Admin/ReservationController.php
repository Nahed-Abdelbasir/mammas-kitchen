<?php

namespace App\Http\Controllers\Admin;

use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ReservationConfirmed;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    

    public function index()
    {
        //
        $reservation = Reservation::all();
        return view('admin.reservation.index', compact('reservation'));
    }



    
    public function status($id)
    {
        //
        $reservation = Reservation::find($id);

        $reservation->status = true ;
        $reservation->save();

        Notification::route('mail', $reservation->email)
            ->notify(new ReservationConfirmed());

        return redirect()->back()->with('successMsg',"Reservation Successfully Confirmed !");
        
    }

    


    public function destroy($id)
    {
        //
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->back()->with('successMsg',"Reservation Successfully Deleted !");

    }

    
}
