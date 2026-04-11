<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Add Batch
    </x-slot>
</x-head>
<body>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-12 rounded-background">
                <x-back>
                    <x-slot:route>{{ route('item.batch.index', $item->id) }}</x-slot>
                </x-back>
                <div class="container-md">
                    <h1>Create Batch</h1>
                    <h4>({{ $item->name }})</h4>
                </div>
                <hr>
                <form class="container-md" action="{{ route('item.batch.store', $item->id) }}" method="post">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="qty">Quantity:</label>
                            <input class="form-control" type="number" min="1" step="1" id="init_qty" name="init_qty" required><br>
                            <label for="expiry_date">Expiration Date:</label>
                            <input class="form-control" type="date" id="expiry_date" name="expiry_date">
                            <br>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="d-none d-md-inline">
                            <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                                <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">CREATE<br>BATCH</h4>
                            </button>
                        </div>
                    </div>

                    <div class="d-md-none">
                        <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                            <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">CREATE<br>BATCH</h4>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>