<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Venue;
use App\Models\Booking;

class VenueController extends Controller
{
    public function index(){
        $venue = Venue::all();

        return Inertia::render('Venue', [
            'venue' => $venue
        ]);
    }

    public function add(){

        $user = User::where('role', 'user')->get();

        return Inertia::render('Venue/Add', [
            'user' => $user,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => ['required'],
            'kategori' => ['required'],
            'alamat' => ['required'],
            'jadwalBooking' => ['required','array']
        ]);

        $image = $request->file('image');
        $imageFilename = Carbon::now()->timestamp."_".$image->getClientOriginalName();

        $image->storeAs(
            'public/images',
            $imageFilename
        );

        //dd(Carbon::parse($request->jadwalBooking[0]['date']));

        $venue_id = Venue::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'alamat' => $request->alamat,
            'image' => $imageFilename
        ])->id;

        foreach($request->jadwalBooking as $data){
            Booking::create([
                'venue_id' => $venue_id,
                'user_id' => $data['userId'],
                'tanggal' => Carbon::parse($request->jadwalBooking[0]['date']),
                'harga' => $data['harga']
            ]);
        }

        return to_route('venue');
    }

    public function destroy(Request $request){
        $request->validate([
            'id_venue' => ['required'],
        ]);

        $venue = Venue::find($request->id_venue);
        $venue->delete();
    }
}
