<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic: Inventory</title>
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
        h1, h2, h4, a, th, td {
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

        .nav-btn:hover, .item-btn:hover {
            background-color: #d6e0e8;
        }
    </style>

    <nav class="navbar navbar-expand-md navbar-light" style="justify-content:flex-start; background-color:#f3f7fa">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" style="margin-right:1rem">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('item.index') }}"><img src="{{ asset('storage/logo.png') }}" width=200px height=auto></a>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link btn nav-btn" href="{{ route('item.index') }}">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn nav-btn" href="{{ route('item.create') }}">Create Item</a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-12 rounded-background">
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 style="display:inline;">Inventory</h1>
                        <h4 style="display:inline;">({{ $items->count() }})</h4>
                    </div>
                    <!-- <div class="d-none d-md-inline">
                        <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('export') }}" style="width:11em">
                            <h2 style="margin:0">Export</h4>
                            <i class="bi-box-arrow-up-right" style="font-size:2em;line-height:1em"></i>
                        </a>
                    </div> -->
                </div>
                @if ($items->isEmpty())
                    <hr>
                    <br>
                    <h4>No Items Found</h4>
                    <br>
                    <h4><a href="{{ route('item.create') }}">Create Item?</a></h4>
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
                            <th scope="col" style="vertical-align:middle">Inventory</th>
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
                                        {{ $item->batches->sortBy('expiry_date')->first()->expiry_date ?? "N/A" }}
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