<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic: Show Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <style>
        h1, h4, a, th, td {
            font-family: "Lato", sans-serif;
        }

        .nav-btn {
            background-color: #f3f7fa;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .item-btn {
            background-color: white;
            width: 100%;
            text-align: left;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .action-btn {
            width: 9em;
        }

        .nav-btn:hover, .item-btn:hover {
            background-color: #d6e0e8;
        }

        .delete-btn {
            width: 11em;
        }

        .delete-btn:hover {
            background-color: #ffcccb;
        }
    </style>

    <x-navbar></x-navbar>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-12 rounded-background">
                <div class="d-md-none">
                    <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('item.index') }}" style="width: 8em">
                        <i class="bi-arrow-left" style="font-size:2em;line-height:1em"></i>
                        <h4 style="margin:0">BACK</h4>
                    </a>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <h1>{{ $item->name }}</h1>
                    </div>
                    
                    <div class="d-none d-md-inline">
                        <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('item.index') }}">
                            <i class="bi-arrow-left" style="font-size:2em;line-height:1em"></i>
                            <h4 style="margin:0">BACK</h4>
                        </a>
                    </div>
                </div>
                <hr>
                <div class="container-md d-flex justify-content-between">
                    <div>
                        <h4>Quantity: {{ $item->batches->sum('qty') - $item->transactions->sum('qty') }}</h4>
                        <h4>Earliest Expiry Date: {{ $item->batches->sortBy('expiry_date')->first()->expiry_date ?? "N/A" }}</h4>
                        <br>
                        <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('item.batch.index', $item->id) }}" style="width: 10em">
                            <h4 style="margin:0">View<br>Batches</h4>
                            <i class="bi-arrow-bar-right" style="font-size:3em;line-height:1em"></i>
                        </a>
                        <br>
                        <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('item.transaction.index', $item->id) }}" style="width: 13em">
                            <h4 style="margin:0">View<br>Transactions</h4>
                            <i class="bi-arrow-bar-right" style="font-size:3em;line-height:1em"></i>
                        </a>
                        <br>
                    </div>
                    
                    <div class="d-none d-md-flex flex-column align-items-end">
                        <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.edit', $item->id) }}">
                            <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">EDIT<br>ITEM</h4>
                        </a>
                        <br>
                        <form action="{{ route('item.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn item-btn action-btn delete-btn d-flex justify-content-between align-items-center">
                                <i class="bi-trash3" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">DELETE<br>ITEM</h4>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="d-flex justify-content-between d-md-none">
                    <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.edit', $item->id) }}">
                        <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">EDIT<br>ITEM</h4>
                    </a>
                    <br>
                    <form action="{{ route('item.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn item-btn action-btn delete-btn d-flex justify-content-between align-items-center">
                            <i class="bi-trash3" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">DELETE<br>ITEM</h4>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>