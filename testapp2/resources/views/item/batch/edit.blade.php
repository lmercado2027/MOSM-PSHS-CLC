<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic: Edit Batch</title>
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
            width: 11em;
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
                <a class="nav-link btn nav-btn" href="{{ route('item.batch.create', $item->id) }}">Create Batch</a>
            </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="row">
            <div class="col-md-12 rounded-background">
                <div class="d-md-none">
                    <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('item.batch.show', [$item->id, $batch->id]) }}" style="width: 8em">
                        <i class="bi-arrow-left" style="font-size:2em;line-height:1em"></i>
                        <h4 style="margin:0">BACK</h4>
                    </a>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <h1>Edit Batch</h1>
                        <h4>({{ $item->name }})</h4>
                    </div>
                    
                    <div class="d-none d-md-inline">
                        <a type="button" class="btn item-btn d-flex justify-content-between align-items-center" href="{{ route('item.batch.show', [$item->id, $batch->id]) }}">
                            <i class="bi-arrow-left" style="font-size:2em;line-height:1em"></i>
                            <h4 style="margin:0">BACK</h4>
                        </a>
                    </div>
                </div>
                <hr>
                <form action="{{ route('item.batch.update', [$item->id, $batch->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="qty">Quantity:</label>
                            <input class="form-control" type="number" min="1" step="1" id="qty" name="qty" value="{{ $batch->qty }}" required><br>
                            <label for="expiry_date">Expiration Date:</label>
                            <input class="form-control" type="date" id="expiry_date" name="expiry_date" value="{{ $batch->expiry_date }}">
                            <br>
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
                                <i class="bi-arrow-repeat" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">UPDATE<br>BATCH</h4>
                            </button>
                        </div>
                    </div>

                    <div class="d-md-none">
                        <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                            <i class="bi-arrow-repeat" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">UPDATE<br>BATCH</h4>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>