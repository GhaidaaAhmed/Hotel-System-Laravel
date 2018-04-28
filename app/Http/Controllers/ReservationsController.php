<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Room;
use DB;
use App\Rules\RoomCapacityRule;
use yajra\Datatables\Datatables;


class ReservationsController extends Controller
{
    //
    public function getPending(){
    //  $usersReservations = User::with('rooms')->get();
    // $roomReservations = Room::with('users')->where('is_confirmed', 0)->get();
    // $reservation = User::with('rooms')->wherePviot('is_confirmed', 0)->get();
     $reservation = User::find(1)->rooms()->where('is_confirmed', 0)->get();

    //$reservation = DB::table('room_user')->where('is_confirmed' , 0)->first();
     dd($reservation);


    }
    public function index()
    {
       //$reservations = DB::table('room_user')->where('user_id', Auth::user()->id)->get();
       // $reservations = User::with('user_id')->get();
     /*  $reservations = User::find(1);
       $reservations = DB::table('room_user')->get();
      // $reservations = User::with('user_id')->get();*/
       $user = User::find(Auth::user()->id);
       //dd($user->rooms());
       /*foreach ($user->rooms as $room) {
        dd($room->pivot->accompany_number,$room->pivot->client_paid_price);
       }*/
        return view('reservations.index',
        [
            'reservations' => $user->rooms 
        ]);
    }
    public function freeRooms(){       
        return view('reservations.freerooms');
    }   

    public function freeRoomsDatatable()
    {        
        $rooms = Room::all()->where('is_reserved','0');
        return Datatables::of($rooms)
        ->addColumn('action', function ($room) {  
            return view('reservations.make-action',['id'=>$room->id]);
        })->make(true);
    }
    public function create($room_id)
    {
       $room = Room::find($room_id);
        return view('reservations.create',['room'=>$room]);
    }   
    public function store($id,Request $request){
        $request->validate([
            'accompany_number' => ['required',new RoomCapacityRule(Room::find($id)->capacity)],
        ]);
        $room=Room::find($id);
        if($room->is_reserved){
            return 'Error';
        }     
        $room->is_reserved=1;
        $room->save();
        $user=Auth::user();
        $user->rooms()->attach($user->id,[
        'accompany_number' => $request->accompany_number,
        'client_paid_price'=>$request->price
        ]);
        return redirect('/client/freerooms'); 
    }
}
