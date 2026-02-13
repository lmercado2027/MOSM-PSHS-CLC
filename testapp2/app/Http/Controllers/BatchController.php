<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Item $item)
    {
        $batches = $item->batches;
        return view('item.batch.index', compact('item', 'batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Item $item)
    {
        return view('item.batch.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'expiry_date' => 'nullable|date|after:today',
            'qty' => 'required|int|gt:0',
        ]);

        Batch::create(array_merge(["item_id" => $item->id], $request->all()));
        return redirect()->route('item.batch.index', $item->id)->with('success', 'Batch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item, Batch $batch)
    {
        return view('item.batch.show', compact('item', 'batch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item, Batch $batch)
    {
        return view('item.batch.edit', compact('item', 'batch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item, Batch $batch)
    {
        $request->validate([
            'expiry_date' => 'nullable|date',
            'qty' => 'required|int|gte:0',
        ]);

        $batch->update(array_merge(["item_id" => $item->id], $request->all()));
        return redirect()->route('item.batch.index', $item->id)->with('success', 'Batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item, Batch $batch)
    {
        $batch->delete();
        return redirect()->route('item.batch.index', $item->id)->with('success', 'Batch deleted successfully.');
    }
}
