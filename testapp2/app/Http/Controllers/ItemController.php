<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Batch;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Item::all();
        $date_now = getdate();
        foreach ($items as $item) {
            $item->qty = $item->batches->sum('qty') - $item->transactions->sum('qty');
            $item->expiry_date = $item->batches->sortBy('expiry_date')->first()->expiry_date ?? "N/A";

            $item->qty_warning = 0;
            if ($item->low_warning_threshold && $item->qty < $item->low_warning_threshold) {
                $item->qty_warning = 1;
            } if ($item->mid_warning_threshold && $item->qty < $item->mid_warning_threshold) {
                $item->qty_warning = 2;
            } if ($item->high_warning_threshold && $item->qty < $item->high_warning_threshold) {
                $item->qty_warning = 3;
            }

            $item->status = 0;
            if ($date_now <= $item->expiry_date) {
                $item->status = 2;
            } if ($item->qty == 0) {
                $item->status = 1;
            }
        }

        $items = $items->sortBy('name');
        if (in_array($request->sort, ['qty', 'status', 'expiry_date'])) {
            $items = $items->sortBy($request->sort);
        }
        return view('item.index', compact('items', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:items|max:255',
            'category' => 'required|string',
            'dose' => 'nullable|string',
            'unit' => 'nullable|string',
            'size' => 'nullable|string',
            'grouping'  => 'nullable|string',
            'high_warning_threshold' => 'nullable|int|gt:0',
            'mid_warning_threshold' => 'nullable|int|gt:0',
            'low_warning_threshold' => 'nullable|int|gt:0',
        ]);

        //dd($request->category);
        $newItem = new Item();
        $newItem->name = $request->name;
        $newItem->category = $request->category;
        $newItem->high_warning_threshold = $request->high_warning_threshold;
        $newItem->mid_warning_threshold = $request->mid_warning_threshold;
        $newItem->low_warning_threshold = $request->low_warning_threshold;
        $newItem->save();
        return redirect()->route('item.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|unique:items|max:255',
        ]);

        $item->update($request->all());
        return redirect()->route('item.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with('success', 'Item deleted successfully.');
    }
}
