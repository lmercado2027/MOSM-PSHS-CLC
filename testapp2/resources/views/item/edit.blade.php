<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Edit Item
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
                <div class="container-md">
                    <h1>Edit Item</h1>
                    <h4>({{ $item->name }})</h4>
                </div>
                <hr>
                <form class="container-md" action="{{ route('item.update', $item->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ $item->name }}" required>
                        </div>
                        <div class="d-none d-md-inline">
                            <button type="submit" class="btn item-btn action-btn d-none d-md-flex justify-content-between align-items-center">
                                <i class="bi-arrow-repeat" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">UPDATE<br>ITEM</h4>
                            </button>
                        </div>
                    </div>

                    <div class="d-md-none">
                        <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                            <i class="bi-arrow-repeat" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">UPDATE<br>ITEM</h4>
                        </button>
                    </div>
                </form>
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
        </div>
    </div>
</body>
</html>