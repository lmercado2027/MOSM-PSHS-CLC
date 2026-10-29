<!DOCTYPE html>
<html lang="en">
<x-head/>
<body>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="container-md rounded-5 p-5">
            <div class="d-flex justify-content-between align-items-center">
                <h1 style="display:inline;"><b>🏥 Heath Services Unit - Inventory</b></h1>
                {{-- <a type="button" class="btn item-btn d-none d-md-flex justify-content-between align-items-center border-black" style="width: 9em;" href="{{ route('export') }}">
                    <p style="margin:0">📄 Transactions</p>
                </a> --}}
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-start">
                    {{-- <h4 style="display:inline; white-space: nowrap;"><b>📅 Month:</b></h4>
                    <input class="form-control" type="date" id="selected_month" name="selected_month"> --}}
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-start">
                    <h4><b>📁 Sort by:</b></h4>
                    @if ($request->sort == "name" && $request->order == "asc")
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 6em;" href="{{ route('item.index', ['sort'=>'name', 'order'=>'desc']) }}">
                            <i class="bi-caret-up-fill"></i>
                            <p style="margin:0">Name</p>
                        </a>
                    @elseif ($request->sort == "name" && $request->order == "desc")
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 6em;" href="{{ route('item.index', ['sort'=>'name', 'order'=>'asc']) }}">
                            <i class="bi-caret-down-fill"></i>
                            <p style="margin:0">Name</p>
                        </a>
                    @else
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 6em;" href="{{ route('item.index', ['sort'=>'name', 'order'=>'asc']) }}">
                            <i class="bi-dash"></i>
                            <p style="margin:0">Name</p>
                        </a>
                    @endif
                    @if ($request->sort == "qty" && $request->order == "asc")
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 7em;" href="{{ route('item.index', ['sort'=>'qty', 'order'=>'desc']) }}">
                            <i class="bi-caret-up-fill"></i>
                            <p style="margin:0">Quantity</p>
                        </a>
                    @elseif ($request->sort == "qty" && $request->order == "desc")
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 7em;" href="{{ route('item.index', ['sort'=>'qty', 'order'=>'asc']) }}">
                            <i class="bi-caret-down-fill"></i>
                            <p style="margin:0">Quantity</p>
                        </a>
                    @else
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 7em;" href="{{ route('item.index', ['sort'=>'qty', 'order'=>'asc']) }}">
                            <i class="bi-dash"></i>
                            <p style="margin:0">Quantity</p>
                        </a>
                    @endif
                    @if ($request->sort == "expiry_date" && $request->order == "asc")
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 8em;" href="{{ route('item.index', ['sort'=>'expiry_date', 'order'=>'desc']) }}">
                            <i class="bi-caret-up-fill"></i>
                            <p style="margin:0">Expiry Date</p>
                        </a>
                    @elseif ($request->sort == "expiry_date" && $request->order == "desc")
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 8em;" href="{{ route('item.index', ['sort'=>'expiry_date', 'order'=>'asc']) }}">
                            <i class="bi-caret-down-fill"></i>
                            <p style="margin:0">Expiry Date</p>
                        </a>
                    @else
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 8em;" href="{{ route('item.index', ['sort'=>'expiry_date', 'order'=>'asc']) }}">
                            <i class="bi-dash"></i>
                            <p style="margin:0">Expiry Date</p>
                        </a>
                    @endif
                </div>
                <div class="d-flex justify-content-start">
                    <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 7.5em;" href="{{ route('item.create') }}">
                        <i class="bi-plus-circle"></i>
                        <p style="margin:0">Add Item</p>
                    </a>
                    <a type="button" class="btn item-btn mx-2 d-none d-md-flex justify-content-between align-items-center border-black" style="width: 6.5em;" href="{{ route('export') }}">
                        <p style="margin:0">💾 Export</p>
                    </a>
                </div>
            </div>
            @if ($items->isEmpty())
                <br>
                <h4><b>No Items Found</b></h4>
            @endif
            @foreach (['drug', 'topical_oral', 'supplies'] as $category)
                @if ($items->where('category', $category)->isNotEmpty())
                    <br>
                    <div style="text-align: center"><h4><b>
                        @if ($category == "drug")
                            Drugs
                        @elseif ($category == "topical_oral")
                            Topical/Oral
                        @else
                            Supplies
                        @endif
                    </b></h4></div>
                    <div style="border: 0.25em solid; border-radius: 0.25em;">
                        <table class="table m-0">
                            <thead>
                                <th scope="col">
                                    <b>Name</b>
                                </th>
                                <th scope="col">
                                    <b>Current Inventory</b>
                                </th>
                                <th scope="col">
                                    <b>Status</b>
                                </th>
                                <th scope="col">
                                    <b>Expiration Date</b>
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
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</body>
</html>