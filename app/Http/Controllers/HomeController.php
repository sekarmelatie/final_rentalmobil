<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\RentalMobil;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();

        return view('home', compact('mobils'));
    }

    public function viewRental($id) 
    {
        $rentalMobil = RentalMobil::find($id);
        $mobil = Mobil::where('rental_mobil_id', $id)->latest()->get();

        return view('rentalMobil', [
            'rentalMobil' => $rentalMobil,
            'mobils' => $mobil
        ]);
    }
}
