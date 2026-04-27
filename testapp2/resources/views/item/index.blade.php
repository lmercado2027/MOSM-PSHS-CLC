<!DOCTYPE html>
<html lang="en">
<x-head/>
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
                    <div class="d-flex justify-content-start">
                        <a class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.create') }}">
                            <i class="bi-plus-lg" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">CREATE<br>ITEM</h4>
                        </a>
                        <a type="button" class="btn item-btn action-btn d-none d-md-flex justify-content-between align-items-center" href="{{ route('export') }}">
                            <h2 style="margin:0">Export</h4>
                            <i class="bi-box-arrow-up-right" style="font-size:2em;line-height:1em"></i>
                        </a>
                    </div>
                </div>
                @if ($items->isEmpty())
                    <hr>
                    <br>
                    <h4>No Items Found</h4>
                @endif
                @foreach (['drug', 'topical_oral', 'supplies'] as $category)
                    @if ($items->where('category', $category)->isNotEmpty())
                        <hr>
                        <br>
                        <h4>
                            @if ($category == "drug")
                                Drugs
                            @elseif ($category == "topical_oral")
                                Topical/Oral
                            @else
                                Supplies
                            @endif
                        </h4>
                        <table class="table">
                            <thead>
                                <th scope="col">
                                    <a class="btn item-btn" href="{{ route('item.index', ['sort'=>'name']) }}">
                                        <b>Name</b>
                                    </a>
                                </th>
                                <th scope="col">
                                    <a class="btn item-btn" href="{{ route('item.index', ['sort'=>'qty']) }}">
                                        <b>Quantity</b>
                                    </a>
                                </th>
                                <th scope="col">
                                    <a class="btn item-btn" href="{{ route('item.index', ['sort'=>'status']) }}">
                                        <b>Status</b>
                                    </a>
                                </th>
                                <th scope="col">
                                    <a class="btn item-btn" href="{{ route('item.index', ['sort'=>'expiry_date']) }}">
                                        <b>Earliest Expiration Date</b>
                                    </a>
                                </th>
                            </thead>
                            <tbody id="databaseTable">
                                @foreach ($items->where('category', $category) as $item)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('item.show', $item->id) }}" class="btn item-btn" role="button">{{ $item->full_name }}</a>
                                        </th>
                                        <td>
                                            <a href="{{ route('item.show', $item->id) }}" class="btn item-btn" role="button" style="background-color: {{ ['white', 'gold', 'orange', 'red'][$item->qty_warning] }};">
                                                @if ($item->qty_warning > 0)
                                                    <b style="color: white;">{{ $item->qty }}</b>
                                                @else
                                                    {{ $item->qty }}
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('item.show', $item->id) }}" class="btn item-btn" role="button">{{ ['Available', 'Out of Stock', 'EXPIRED'][$item->status] }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('item.show', $item->id) }}" class="btn item-btn" role="button" style="background-color: {{ ['white', 'gold', 'orange', 'red'][$item->time_warning] }};">
                                                @if ($item->time_warning > 0)
                                                    <b style="color: white;">{{ $item->expiry_date }}</b>
                                                @else
                                                    {{ $item->expiry_date }}
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>