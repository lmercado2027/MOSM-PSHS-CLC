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
        <x-back>
            <x-slot:route>{{ route('item.show', $item->id) }}</x-slot>
        </x-back>
        <div class="container-md rounded-5 p-5">
            <div>
                <h1 style="display:inline;"><b>Create Transaction</b></h1>
            </div>
            <br>
            <h4>({{ $item->brand ?? $item->name }})</h4>
            <form class="container-md" action="{{ route('item.transaction.store', $item->id) }}" method="post">
                @csrf
                <div class="d-flex justify-content-between">
                    <div class="form-group col">
                        <div class="row">
                            <div class="col"><label for="type"><b>Type:</b></label></div>
                            <div class="col"><select id="type" name="type" class="form-control" required onchange="
                                    $('#qtyInput').hide();
                                    $('#qty')[0].value = '';
                                    $('#expiryInput').hide();
                                    $('#expiry_date')[0].value = '';
                                    if ($('#type')[0].value == 'Added') {
                                        $('#expiryInput').show();
                                        $('label[for=\'qty\']')[0].innerHTML = '<b>Quantity Added:</b>';
                                    } else {
                                        $('label[for=\'qty\']')[0].innerHTML = '<b>Quantity Taken:</b>';
                                }
                                if ($('#type')[0].value != 'Expired') {
                                    $('#qtyInput').show();
                                    }
                                    ">
                                <option value="">Select...</option>
                                <option value="Added">Added</option>
                                <option value="Consumed">Consumed</option>
                                <option value="Expired">Expired</option>
                            </select></div>
                        </div>
                        <div class="row" id="qtyInput">
                            <div class="col"><label for="qty"><b>Quantity:</b></label></div>
                            <div class="col"><input class="form-control" type="number" min="1" step="1" id="qty" name="qty"></div>
                        </div>
                        <div class="row" id="expiryInput">
                            <div class="col"><label for="expiry_date"><b>Expiration Date:</b></label></div>
                            <div class="col"><input class="form-control" type="date" id="expiry_date" name="expiry_date"></div>
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
                    <div class="form-group col">
                    </div>
                </div>

                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn nav-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 11.5em;" href="{{ route('item.index', ['sort'=>'name']) }}">
                        <i class="bi-plus-square"></i>
                        <p style="margin:0">Create Transaction</p>
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <script>
        $('#qtyInput').hide()
        $('#expiryInput').hide()
    </script>
</body>
</html>