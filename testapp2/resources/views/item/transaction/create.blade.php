<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Add Transaction
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
                    <x-slot:route>{{ route('item.transaction.index', $item->id) }}</x-slot>
                </x-back>
                <div class="container-md">
                    <h1>Create Transaction</h1>
                    <h4>({{ $item->brand ?? $item->name }})</h4>
                </div>
                <hr>
                <form class="container-md" action="{{ route('item.transaction.store', $item->id) }}" method="post">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select id="type" name="type" class="form-control" required onchange="
                                    $('#qtyInput').hide();
                                    $('#qty')[0].value = '';
                                    $('#expiryInput').hide();
                                    $('#expiry_date')[0].value = '';
                                    if ($('#type')[0].value == 'Added') {
                                        $('#expiryInput').show();
                                        $('label[for=\'qty\']')[0].innerText = 'Quantity Added:';
                                    } else {
                                        $('label[for=\'qty\']')[0].innerText = 'Quantity Taken:';
                                    }
                                    if ($('#type')[0].value != 'Expired') {
                                        $('#qtyInput').show();
                                    }
                                ">
                                <option value="">Select...</option>
                                <option value="Added">Added</option>
                                <option value="Consumed">Consumed</option>
                                <option value="Expired">Expired</option>
                            </select>
                            <div id="qtyInput">
                                <label for="qty">Quantity:</label>
                                <input class="form-control" type="number" min="1" step="1" id="qty" name="qty">
                            </div>
                            <div id="expiryInput">
                                <label for="expiry_date">Expiration Date:</label>
                                <input class="form-control" type="date" id="expiry_date" name="expiry_date">
                            </div>
                            <br>
                            <input class="form-control" type="text" id="nurse" name="nurse" value="{{ Auth::user()->name . ' (' . Auth::user()->email . ')' }}" hidden>
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
                                <h4 style="margin:0">CREATE<br>TRANSACTION</h4>
                            </button>
                        </div>
                    </div>

                    <div class="d-md-none">
                        <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                            <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">CREATE<br>TRANSACTION</h4>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#qtyInput').hide()
        $('#expiryInput').hide()
    </script>
</body>
</html>