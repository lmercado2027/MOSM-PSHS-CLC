<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: {{ $item->name }}
    </x-slot>
</x-head>
<body>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="">
            <x-back/>
            <div class="container-md rounded-5 p-5">
                <h1><b>{{ $item->category == "drug" ? '💊 ' : ($item->category == 'topical_oral' ? '🧴 ' : '📦 ') }}{{ $item->full_name }}</b></h1>
                <div class="d-flex justify-content-start">
                    <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 7em;" href="{{ route('item.edit', $item->id) }}">
                        <i class="bi-pencil-square"></i>
                        <p style="margin:0">Edit Item</p>
                    </a>
                    <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 11em;" href="{{ route('item.transaction.create', $item->id) }}">
                        <i class="bi-plus-lg"></i>
                        <p style="margin:0">Make Transaction</p>
                    </a>
                    <form action="{{ route('item.destroy', $item->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn item-btn delete-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 8em;" href="{{ route('item.index', ['sort'=>'qty']) }}">
                            <i class="bi-trash3"></i>
                            <p style="margin:0">Delete Item</p>
                        </button>
                    </form>
                </div>

                <div class="d-flex justify-content-between">
                    <div style="text-align: center">
                        @if ($item->batches->isEmpty())
                            <br>
                            <br>
                            <h3><b>No Batches Found<b></h3>
                        @endif
                        @if ($item->batches->isNotEmpty())
                            <br>
                            <h4><b>Batch List</b></h4>
                            <div style="border: 0.25em solid; border-radius: 0.25em;">
                                <table class="table m-0">
                                    <thead>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Expiration Date</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->batches->sortBy('expiry_date') as $batch)
                                            <tr>
                                                <th scope="row">
                                                    {{ $batch->curr_qty }}
                                                </th>
                                                <td>
                                                    {{ $batch->expiry_date ?? "N/A" }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div style="text-align: center">
                        @if ($item->transactions->isEmpty())
                            <br>
                            <br>
                            <h3><b>No Transactions Found<b></h3>
                        @endif
                        @if ($item->transactions->isNotEmpty())
                            <br>
                            <h4><b>Transaction List</b></h4>
                            <div style="border: 0.25em solid; border-radius: 0.25em;">
                                <table class="table m-0">
                                    <thead>
                                        <th scope="col">Quantity Added/Removed</th>
                                        <th scope="col">Transaction Type</th>
                                        <th scope="col">Added Expiry Date</th>
                                        <th scope="col">Nurse</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->transactions as $transaction)
                                            <tr>
                                                <th scope="row">
                                                    {{ $transaction->qty }}
                                                </th>
                                                <td scope="row">
                                                    {{ $transaction->type }}
                                                </td>
                                                <td scope="row">
                                                    {{ $transaction->expiry_date }}
                                                </td>
                                                <td scope="row">
                                                    {{ $transaction->nurse }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>