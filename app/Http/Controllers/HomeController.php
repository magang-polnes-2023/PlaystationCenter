<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listgame;
use App\Models\Playstation;
use Filament\Pages\Dashboard;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $playstation = Playstation::with('listgame')->get();

        return view('home', compact('playstation'));
    }

    public function howtobook()
    {
        return view('howtobook');
    }
}
