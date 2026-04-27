<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Batch;
use Illuminate\Http\Request;

use App\Exports\InventoryExport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;

class ItemController extends Controller
{
    public function expand_name(Item $item)
    {
        $item->full_name = $item->name;
        if ($item->brand) {
            $item->full_name .= " (" . $item->brand . ")";
        } if ($item->dose) {
            $item->full_name .= " " . $item->dose;
        } if (in_array($item->unit, ['cap', 'tab'])) {
            if ($item->dose) {
                $item->full_name .= "/" . $item->unit;
            } else {
                $item->full_name .= " " . $item->unit;
            }
        } if (in_array($item->unit, ['pack', 'sachet', 'syrup'])) {
            $item->full_name .= " " . $item->unit;
        } if ($item->size) {
            $item->full_name .= " " . $item->size;
        } if ($item->grouping) {
            $item->full_name .= " " . $item->grouping;
        }

        return $item;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Item::all();
        $date_now = date("Y-m-d");
        foreach ($items as $item) {
            $item->qty = $item->batches->sum('curr_qty');
            $item->expiry_date = $item->batches->filter(function (Batch $value, int $key) {
                return $value->curr_qty > 0  && $value->expiry_date;
            })->sortBy('expiry_date')->first()->expiry_date ?? "N/A";

            $item->qty_warning = 0;
            if ($item->low_warning_threshold && $item->qty < $item->low_warning_threshold) {
                $item->qty_warning = 1;
            } if ($item->mid_warning_threshold && $item->qty < $item->mid_warning_threshold) {
                $item->qty_warning = 2;
            } if ($item->high_warning_threshold && $item->qty < $item->high_warning_threshold) {
                $item->qty_warning = 3;
            }

            $item->time_warning = 0;
            if (date_create($item->expiry_date)) {
                if (date_create($item->expiry_date)->diff(new DateTime())->days <= 30) {
                    $item->time_warning = 1;
                } if (date_create($item->expiry_date)->diff(new DateTime())->days <= 10) {
                    $item->time_warning = 2;
                } if (date_create($item->expiry_date)->diff(new DateTime())->days <= 5) {
                    $item->time_warning = 3;
                }
            }

            $item->status = 0;
            if ($item->expiry_date <= $date_now) {
                $item->status = 2;
            } if ($item->qty == 0) {
                $item->status = 1;
            }

            $item = ItemController::expand_name($item);
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
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'required|string',
            'dose' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'grouping'  => 'nullable|string|max:255',
            'high_warning_threshold' => 'nullable|int|gt:0',
            'mid_warning_threshold' => 'nullable|int|gt:' . ($request->high_warning_threshold ?? 0),
            'low_warning_threshold' => 'nullable|int|gt:' . ($request->mid_warning_threshold ?? $request->high_warning_threshold ?? 0),
        ]);

        $newItem = new Item();
        $newItem->category = $request->category;
        $newItem->name = $request->name;
        $newItem->brand = $request->brand;
        $newItem->dose = $request->dose;
        $newItem->unit = $request->unit;
        $newItem->size = $request->size;
        $newItem->grouping = $request->grouping;
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
        $item->qty = $item->batches->sum('curr_qty');
        $item->expiry_date = $item->batches->filter(function (Batch $value, int $key) {
            return $value->curr_qty > 0  && $value->expiry_date;
        })->sortBy('expiry_date')->first()->expiry_date ?? "N/A";
        $item = ItemController::expand_name($item);
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $item = ItemController::expand_name($item);
        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'dose' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'grouping'  => 'nullable|string|max:255',
            'high_warning_threshold' => 'nullable|int|gt:0',
            'mid_warning_threshold' => 'nullable|int|gt:' . ($request->high_warning_threshold ?? 0),
            'low_warning_threshold' => 'nullable|int|gt:' . ($request->mid_warning_threshold ?? $request->high_warning_threshold ?? 0),
        ]);

        $item->name = $request->name;
        $item->brand = $request->brand;
        $item->dose = $request->dose;
        $item->unit = $request->unit;
        $item->size = $request->size;
        $item->grouping = $request->grouping;
        $item->high_warning_threshold = $request->high_warning_threshold;
        $item->mid_warning_threshold = $request->mid_warning_threshold;
        $item->low_warning_threshold = $request->low_warning_threshold;
        $item->save();
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

    public function export(Request $request)
    {
        $items = Item::all();

        $tableData = [];
        $tableData[] = [''];
        $tableData[] = ['', 'INVENTORY'];
        $tableData[] = ['', 'Health Services Unit'];
        $tableData[] = [''];
        $tableData[] = ['', 'as of ' . date('F j, Y')];
        $tableData[] = [''];
        for ($i = 0; $i < 3; $i++) {
            if ($request[['drug', 'topical_oral', 'supplies'][$i]]) {
                $tableData[] = ['ID', ['Drug Name', 'Topical/Oral', 'Supplies'][$i], 'Quantity', 'Expiration Date'];
                foreach ($items->filter(function (Item $value, int $key) use ($i) {
                    return $value->category == (['drug', 'topical_oral', 'supplies'][$i]);
                }) as $item) {
                    $item->qty = $item->batches->sum('curr_qty');
                    $item->expiry_date = $item->batches->filter(function (Batch $value, int $key) {
                        return $value->curr_qty > 0;
                    })->sortBy('expiry_date')->first()->expiry_date ?? 'N/A';
                    $item = ItemController::expand_name($item);
                
                    $tableData[] = [
                        $item->id,
                        $item->full_name,
                        $item->qty,
                        $item->expiry_date,
                    ];
                }
                $tableData[] = [''];
            }
        }

        return Excel::download(new InventoryExport($tableData), 'Inventory (' . date('F j, Y') . ').xlsx');
    }
}
