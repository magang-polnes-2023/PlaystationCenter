<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Playstation;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Order user's account.
     */
    public function order()
    {
        $user = Auth::user();

        // Get bookings associated with the current user with eager loading of user and playstation data
        $booking = Booking::with('user', 'playstation')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        return view('order.order', compact('booking'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'playstation_id' => 'required',
            'user_id' => 'required',
            'booking_code' => 'required',
            'booking_date' => 'required',
            'booking_duration' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_pay' => 'required',
            'payment' => 'required|image|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('payment')) {

            $payment = $request->file('payment');
            $payment->storeAs('public/', $payment->hashName());

            Storage::delete('public/' . $booking->payment);

            $booking->update([
                'playstation_id' => $request->playstation_id,
                'user_id' => $request->user_id,
                'booking_code' => $request->booking_code,
                'booking_date' => $request->booking_date,
                'booking_duration' => $request->booking_duration,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'total_pay' => $request->total_pay,
                'payment' => $payment->hashName()
            ]);
        } else {
            $booking->update([
                'playstation_id' => $request->playstation_id,
                'user_id' => $request->user_id,
                'booking_code' => $request->booking_code,
                'booking_date' => $request->booking_date,
                'booking_duration' => $request->booking_duration,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'total_pay' => $request->total_pay,
            ]);
        }

        return redirect()->route('order.order')->with(['success' => 'Booking payment updated successfully!']);
    }

    public function index(string $id)
    {

        $booking = Booking::findOrFail($id);

        return view('order.card', compact('booking'));
    }
}
