<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    // Pembelian tiket
    public function buyTicket(Request $request)
    {
        // Validasi data
        $request->validate([
            'event' => 'required|string',
            'date' => 'required|date',
            'seat' => 'required|string|unique:tickets,seat',
        ]);

        // Simpan tiket ke database
        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'event' => $request->event,
            'date' => $request->date,
            'seat' => $request->seat,
            'status' => 'active', // Tiket aktif
        ]);

        return response()->json([
            'message' => 'Tiket berhasil dibeli!',
            'ticket' => $ticket,
        ]);
    }

    // Melihat tiket pengguna
    public function myTickets()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();

        return response()->json($tickets);
    }
}
