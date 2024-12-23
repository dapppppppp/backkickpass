<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json($tickets);
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        return response()->json($ticket);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'price_tribun' => 'required|string',
            'stock_tribun' => 'required|integer',
            'price_vip' => 'required|string',
            'stock_vip' => 'required|integer',
        ]);

        $ticket = Ticket::create($request->all());
        return response()->json(['message' => 'Ticket created successfully', 'ticket' => $ticket], 201);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $ticket->update($request->all());
        return response()->json(['message' => 'Ticket updated successfully', 'ticket' => $ticket]);
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted successfully']);
    }
}