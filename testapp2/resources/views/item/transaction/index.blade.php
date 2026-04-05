<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: {{ $item->name }}
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
                    <x-slot:route>{{ route('item.show', $item->id) }}</x-slot>
                </x-back>
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 style="display:inline;">Transactions</h1>
                        <h4 style="display:inline;">({{ $transactions->count() }})</h4>
                        <h4>({{ $item->name }})</h4>
                    </div>
                    <a class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.transaction.create', $item->id) }}">
                        <i class="bi-plus-lg" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">CREATE<br>TRANSACTION</h4>
                    </a>
                </div>
                @if ($transactions->isEmpty())
                    <hr>
                    <br>
                    <h4>No Transactions Found</h4>
                    <br>
                @endif
                @if ($transactions->isNotEmpty())
                    <br>
                    <table class="table">
                        <thead>
                            <th scope="col" style='padding:1.125rem 1.5rem'>Quantity Taken</th>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('item.transaction.show', [$item->id, $transaction->id]) }}" class="btn item-btn" role="button">{{ $transaction->qty }}</a>
                                    </th>
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