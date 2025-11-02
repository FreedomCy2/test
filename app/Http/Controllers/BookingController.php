<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // 🧍‍♀️ Patient booking form
    public function create()
    {
        return view('patient.booking');
    }

    // 🧍‍♀️ Store booking
    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'age' => 'required|integer',
            'gender' => 'required',
        ]);

        Booking::create($request->all());

        return redirect()->back()->with('success', 'Booking submitted successfully!');
    }

    // 🩺 Doctor view all bookings
    public function index()
    {
        $bookings = Booking::all();
        return view('doctor.appointment', compact('bookings'));
    }

    // 🩺 Doctor accept booking
    public function accept($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Accepted';
        $booking->save();

        return back()->with('success', 'Booking accepted!');
    }

    // 🩺 Doctor decline booking
    public function decline($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Declined';
        $booking->save();

        return back()->with('success', 'Booking declined!');
    }
}
