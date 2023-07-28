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
    public function index(string $id)
    {

        $booking = Booking::findOrFail($id);

        return view('order.card', compact('booking'));
    }

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
            ->withTrashed()
            ->paginate(5);

        return view('order.order', compact('booking'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'payment' => 'required|image|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        $payment = $request->file('payment');
        $payment->storeAs('public/', $payment->hashName());

        Storage::delete('public/' . $booking->payment);

        $booking->update([
            'payment' => $payment->hashName()
        ]);

        return redirect()->route('order.order')->with(['success' => 'Booking payment updated successfully!']);
    }

    public function cancle(string $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'status' => 'Cancel'
        ]);

        return redirect()->route('order.order')->with(['success' => 'Booking cancelled successfully!']);
    }
}
