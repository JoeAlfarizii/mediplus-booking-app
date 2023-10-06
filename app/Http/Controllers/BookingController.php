<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Venue;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index(String $venue_id){
        $venue = Venue::find($venue_id);
        $venue->imageurl = url('/')."/storage/images/".$venue->image;

        $booking = Booking::where('venue_id', $venue_id)->get()->filter( function($book){
            if($book->user_id != 0){
                $user = user::find($book->user_id);
                $book->by = $user->name;
            }else{
                $book->by = '-';
            }

            $book->harga = number_format($book->harga, 2);

            return $book;
        });

        return Inertia::render('Booking/Booking', [
            'venue' => $venue,
            'booking' => $booking
        ]);
    }

    public function book(Request $request){
        $request->validate([
            'user_id' => ['required'],
            'book_id' => ['required'],
        ]);

        $booking = Booking::find($request->book_id);
        
        if($booking->user_id != 0){
            return response()->json([
                'status' => '503',
                'message' => 'Venue telah terbooking oleh user lain!'
            ], 503);
        }

        $booking->user_id = $request->user_id;
        $booking->save();
    }
}
