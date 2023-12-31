<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listgame;
use App\Models\Playstation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(string $id)
    {
        $playstation = Playstation::find($id);
        $listgame = Listgame::all();
        $user = Auth::User();
        $prefix = 'ORD-PS-';

        $latestBooking = Booking::orderByDesc('id')->first();
        $increment = $latestBooking ? intval(substr($latestBooking->booking_code, -3)) + 1 : 1;
        $bookingCode = $prefix . str_pad($increment, 3, '0', STR_PAD_LEFT);

        $bookedTimes = Booking::select('booking_date', 'start_time', 'end_time')
            ->where('playstation_id', $playstation->id)
            ->whereNotIn('status', ['Selesai', 'Cancel'])
            ->get();

        return view('order.booking', compact('playstation', 'listgame', 'user', 'bookedTimes', 'bookingCode'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'playstation_id' => 'required',
            'user_id' => 'required',
            'booking_code' => 'required|unique:bookings',
            'booking_date' => 'required',
            'booking_duration' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_pay' => 'required',
        ]);

        Booking::create([
            'playstation_id' => $request->playstation_id,
            'user_id' => $request->user_id,
            'booking_code' => $request->booking_code,
            'booking_date' => $request->booking_date,
            'booking_duration' => $request->booking_duration,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_pay' => $request->total_pay,
        ]);

        try {
            $booking = Booking::where('booking_code', $request->booking_code)->firstOrFail();

            return view('order.card', compact('booking'));
        } catch (ModelNotFoundException $e) {
            
            return redirect()->route('home')->with(['error' => 'Booking not found']);
        }
    }
}