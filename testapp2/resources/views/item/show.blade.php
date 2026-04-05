<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Show Item
    </x-slot>
</x-head>
<body>
    <style>
        .action_btn {
            width: 9em;
        }
    </style>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-12 rounded-background">
                <x-back/>
                <div class="container-md">
                    <h1>{{ $item->name }}</h1>
                </div>
                <hr>
                <div class="container-md d-flex justify-content-between">
                    <div>
                        <h4>Quantity: {{ $item->batches->sum('qty') - $item->transactions->sum('qty') }}</h4>
                        <h4>Earliest Expiry Date: {{ $item->batches->sortBy('expiry_date')->first()->expiry_date ?? "N/A" }}</h4>
                        <br>
                        <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('item.batch.index', $item->id) }}" style="width: 10em">
                            <h4 style="margin:0">View<br>Batches</h4>
                            <i class="bi-arrow-bar-right" style="font-size:3em;line-height:1em"></i>
                        </a>
                        <br>
                        <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('item.transaction.index', $item->id) }}" style="width: 13em">
                            <h4 style="margin:0">View<br>Transactions</h4>
                            <i class="bi-arrow-bar-right" style="font-size:3em;line-height:1em"></i>
                        </a>
                        <br>
                    </div>
                    
                    <div class="d-none d-md-flex flex-column align-items-end">
                        <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.edit', $item->id) }}">
                            <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">EDIT<br>ITEM</h4>
                        </a>
                        <br>
                        <form action="{{ route('item.destroy', $item->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn item-btn action-btn delete-btn d-flex justify-content-between align-items-center">
                                <i class="bi-trash3" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">DELETE<br>ITEM</h4>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="container-md d-flex justify-content-between d-md-none">
                    <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.edit', $item->id) }}">
                        <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">EDIT<br>ITEM</h4>
                    </a>
                    <br>
                    <form action="{{ route('item.destroy', $item->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn item-btn action-btn delete-btn d-flex justify-content-between align-items-center">
                            <i class="bi-trash3" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">DELETE<br>ITEM</h4>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>