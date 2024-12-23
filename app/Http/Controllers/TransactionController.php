<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'ticket')->get();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ticket_id' => 'required|exists:tickets,id',
            'category' => 'required|string',
            'price' => 'required|string',
        ]);

        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'ticket_id' => $request->ticket_id,
            'category' => $request->category,
            'price' => $request->price,
            'kode_tiket' => strtoupper(uniqid()),
        ]);

        return response()->json(['message' => 'Transaction created successfully', 'transaction' => $transaction], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('user', 'ticket')->find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        return response()->json($transaction);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'ticket_id' => 'sometimes|required|exists:tickets,id',
            'category' => 'sometimes|required|string',
            'price' => 'sometimes|required|string',
            'status' => 'sometimes|required|string', // Optional: if you want to update status
        ]);

        $transaction->update($request->all());
        return response()->json(['message' => 'Transaction updated successfully', 'transaction' => $transaction]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();
        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}