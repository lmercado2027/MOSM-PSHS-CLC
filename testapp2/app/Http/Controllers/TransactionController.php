<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Batch;
use App\Models\Transaction;
use Illuminate\Http\Request;

use App\Models\User;

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
            'type' => 'required|string',
            'expiry_date' => 'nullable|date'
        ]);

        if ($request->type == 'Added') {
            $request->validate([
                'qty' => 'required|int|gt:0',
            ]);
            if ($item->batches->contains('expiry_date', $request->expiry_date)) {
                $batch = $item->batches->firstWhere('expiry_date', $request->expiry_date);
                $batch->curr_qty += $request->qty;
                $batch->save();
            } else {
                $newBatch = new Batch();
                $newBatch->item_id = $item->id;
                $newBatch->curr_qty = $request->qty;
                $newBatch->expiry_date = $request->expiry_date;
                $newBatch->save();
            }
        } if ($request->type == 'Consumed') {
            $request->validate([
                'qty' => 'required|int|lte:' . $item->batches->filter(function (Batch $value, int $key) {
                    $date_now = date("Y-m-d");
                    return $value->expiry_date > $date_now;
                })->sum('curr_qty'),
            ]);
            $qty = $request->qty;
            foreach ($item->batches->filter(function (Batch $value, int $key) {
                $date_now = date("Y-m-d");
                return $value->expiry_date > $date_now;
            })->sortBy('expiry_date') as $batch) {
                if ($qty < $batch->curr_qty) {
                    $batch->curr_qty -= $qty;
                    $batch->save();
                    break;
                } else {
                    $qty -= $batch->curr_qty;
                    $batch->curr_qty = 0;
                    $batch->save();
                }
            }
        } if ($request->type == 'Expired') {
            $request->qty = $item->batches->filter(function (Batch $value, int $key) {
                $date_now = date("Y-m-d");
                return ($value->expiry_date <= $date_now) && $value->expiry_date;
            })->sum('curr_qty');
            foreach ($item->batches->filter(function (Batch $value, int $key) {
                $date_now = date("Y-m-d");
                return ($value->expiry_date <= $date_now) && $value->expiry_date;
            })->sortBy('expiry_date') as $batch) {
                $batch->curr_qty = 0;
                $batch->save();
            }
        }
        $newTransaction = new Transaction();
        $newTransaction->item_id = $item->id;
        $newTransaction->qty = $request->qty;
        $newTransaction->type = $request->type;
        $newTransaction->expiry_date = $request->expiry_date;
        $newTransaction->nurse = $request->nurse;
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
