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
        <div class="row">
            <div class="col-md-12 rounded-background">
                <x-back>
                    <x-slot:route>{{ route('item.show', $item->id) }}</x-slot>
                </x-back>
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 style="display:inline;">Batches</h1>
                        <h4 style="display:inline;">({{ $batches->count() }})</h4>
                        <h4>({{ $item->name }})</h4>
                    </div>
                    <a class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.batch.create', $item->id) }}">
                        <i class="bi-plus-lg" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">CREATE<br>BATCH</h4>
                    </a>
                </div>
                @if ($batches->isEmpty())
                    <hr>
                    <br>
                    <h4>No Batches Found</h4>
                    <br>
                @endif
                @if ($batches->isNotEmpty())
                    <br>
                    <table class="table">
                        <thead>
                            <th scope="col" style='padding:1.125rem 1.5rem'>Quantity</th>
                            <th scope="col">
                                Expiration Date
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($batches->sortBy('expiry_date') as $batch)
                                <tr>
                                    <th scope="row">
                                        <a href="{{ route('item.batch.show', [$item->id, $batch->id]) }}" class="btn item-btn" role="button">{{ $batch->qty }}</a>
                                    </th>
                                    <td style='padding:1.125rem 0.75rem'>
                                        {{ $batch->expiry_date ?? "N/A" }}
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