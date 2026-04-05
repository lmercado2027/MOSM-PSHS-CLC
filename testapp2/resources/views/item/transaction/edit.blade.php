<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Edit Transaction
    </x-slot>
</x-head>
<body>
    <style>
        .action-btn {
            width: 16em;
        }
    </style>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-12 rounded-background">
                <x-back>
                    <x-slot:route>{{ route('item.transaction.show', [$item->id, $transaction->id]) }}</x-slot>
                </x-back>
                <div class="container-md">
                    <h1>Edit Transaction</h1>
                    <h4>({{ $item->name }})</h4>
                </div>
                <hr>
                <form class="container-md" action="{{ route('item.transaction.update', [$item->id, $transaction->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="qty">Quantity Taken:</label>
                            <input class="form-control" type="number" min="1" step="1" id="qty" name="qty" value="{{ $transaction->qty }}" required>
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
                                <i class="bi-arrow-repeat" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">UPDATE<br>TRANSACTION</h4>
                            </button>
                        </div>
                    </div>

                    <div class="d-md-none">
                        <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                            <i class="bi-arrow-repeat" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">UPDATE<br>TRANSACTION</h4>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>