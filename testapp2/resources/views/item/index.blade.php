<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Inventory
    </x-slot>
</x-head>
<body>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-12 rounded-background">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 style="display:inline;">Inventory</h1>
                        <h4 style="display:inline;">({{ $items->count() }})</h4>
                    </div>
                    <div class="d-none d-md-inline">
                        <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('export') }}" style="width:11em">
                            <h2 style="margin:0">Export</h4>
                            <i class="bi-box-arrow-up-right" style="font-size:2em;line-height:1em"></i>
                        </a>
                    </div>
                </div>
                @if ($items->isEmpty())
                    <hr>
                    <br>
                    <h4>No Items Found</h4>
                    <br>
                    <a class="btn item-btn" href="{{ route('item.create') }}" style="width: auto">Create Item</a>
                @endif
                @if ($items->isNotEmpty())
                    <br>
                    <table id="theHeadersOfTheTable" class="table">
                        <thead>
                            <th scope="col">
                                <a class="btn item-btn" href="{{ route('item.index', ['sort'=>'name']) }}">
                                    <b>Name</b>
                                </a>
                            </th>
                            <th scope="col" style="vertical-align:middle">Quantity</th>
                            <th scope="col">
                                <a class="btn item-btn" href="{{ route('item.index', ['sort'=>'expiry_date']) }}">
                                    <b>Earliest Expiration Date</b>
                                </a>
                            </th>
                        </thead>
                        <tbody id="databaseTable">
                            @foreach ($items as $item)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('item.show', $item->id) }}" class="btn item-btn" role="button">{{ $item->name }}</a>
                                    </th>
                                    <td style='padding:1.125rem .75rem'>
                                        {{ $item->batches->sum('qty') - $item->transactions->sum('qty') }}
                                    </td>
                                    <td style='padding:1.125rem 1.5rem'>
                                        {{ $item->expiry_date }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</body>
</html>