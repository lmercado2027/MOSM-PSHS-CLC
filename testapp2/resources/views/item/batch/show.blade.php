<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Show Batch
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
                <x-back>
                    <x-slot:route>{{ route('item.batch.index', $item->id) }}</x-slot>
                </x-back>
                <div class="container-md">
                    <h1>Batch</h1>
                    <h4>({{ $item->name }})</h4>
                </div>
                <hr>
                <div class="container-md d-flex justify-content-between">
                    <div>
                        <h4>Quantity: {{ $batch->qty }}</h4>
                        <h4>Expiry Date: {{ $batch->expiry_date ?? "N/A" }}</h4>
                        <br>
                    </div>
                    
                    <div class="d-none d-md-flex flex-column align-items-end">
                        <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.batch.edit', [$item->id, $batch->id]) }}">
                            <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">EDIT<br>BATCH</h4>
                        </a>
                        <br>
                        <form action="{{ route('item.batch.destroy', [$item->id, $batch->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn item-btn action-btn delete-btn d-flex justify-content-between align-items-center">
                                <i class="bi-trash3" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">DELETE<br>BATCH</h4>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="container-md d-flex justify-content-between d-md-none">
                    <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.batch.edit', [$item->id, $batch->id]) }}">
                        <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">EDIT<br>BATCH</h4>
                    </a>
                    <br>
                    <form action="{{ route('item.batch.destroy', [$item->id, $batch->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn item-btn action-btn delete-btn d-flex justify-content-between align-items-center">
                            <i class="bi-trash3" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">DELETE<br>BATCH</h4>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>