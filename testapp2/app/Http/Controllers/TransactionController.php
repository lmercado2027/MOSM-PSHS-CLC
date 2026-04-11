<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Item $item)
    {
        $transactions = $item->transactions;
        return view('item.transaction.index', compact('item', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Item $item)
    {
        return view('item.transaction.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'qty' => 'required|int|lte:' . $item->batches->sum('init_qty') - $item->transactions->sum('qty'),
            'type' => 'required|string',
        ]);

        $newTransaction = new Transaction();
        $newTransaction->item_id = $item->id;
        $newTransaction->qty = $request->qty;
        $newTransaction->type = $request->type;
        $newTransaction->save();
        return redirect()->route('item.transaction.index', $item->id)->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item, Transaction $transaction)
    {
        return view('item.transaction.show', compact('item', 'transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item, Transaction $transaction)
    {
        return view('item.transaction.edit', compact('item', 'transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item, Transaction $transaction)
    {
        $request->validate([
            'qty' => 'required|int|lte:' . $item->batches->sum('qty') - $item->transactions->sum('qty') + $transaction->qty,
        ]);

        $transaction->update(array_merge(["item_id" => $item->id], $request->all()));
        return redirect()->route('item.transaction.index', $item->id)->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item, Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('item.transaction.index', $item->id)->with('success', 'Transaction deleted successfully.');
    }
}
