<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class AdminController extends Controller
{
    // 🧑‍💼 View all bookings
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.edit', compact('bookings'));
    }

    // 🧑‍💼 Update booking
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return back()->with('success', 'Booking updated successfully!');
    }

    // 🧑‍💼 Delete booking
    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Booking deleted successfully!');
    }
}
