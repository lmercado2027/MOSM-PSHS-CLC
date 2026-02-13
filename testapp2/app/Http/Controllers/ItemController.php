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
        if ($request->sort == 'name' || $request->sort == 'expiry_date') {
            $items = Item::all()->sortBy($request->sort);
        } else {
            $items = Item::all();
        }
        return view('item.index', compact('items'));
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
            // TODO: add other fields and automatically create first batch
        ]);

        Item::create($request->all());
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
