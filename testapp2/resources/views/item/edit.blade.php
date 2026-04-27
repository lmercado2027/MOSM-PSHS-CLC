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
                    <h4>({{ $item->full_name }})</h4>
                </div>
                <hr>
                <form class="container-md" action="{{ route('item.update', $item->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <div>
                                <label for="name">
                                    @if ($item->category == 'drug')
                                        Generic Name:
                                    @else
                                        Name:
                                    @endif
                                </label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ $item->name }}" required>
                            </div>
                            @if ($item->category == 'drug')
                                <div>
                                    <label for="brand">Brand Name:</label>
                                    <input class="form-control" type="text" id="brand" name="brand" value="{{ $item->brand }}">
                                </div>
                            @endif
                            @if ($item->category != 'supplies')
                                <div>
                                    <label for="dose">Dose (ex. "10mcg"):</label>
                                    <input class="form-control" type="text" id="dose" name="dose" value="{{ $item->dose }}">
                                </div>
                            @endif
                            <div>
                                <label for="unit">Unit:</label>
                                <select id="unit" name="unit" class="form-control" value="{{ $item->unit }}">
                                    <option value="">Select...</option>
                                    <option value="cap" @if ($item->unit == 'cap')
                                        selected
                                    @endif
                                    >Capsule</option>
                                    <option value="pack" @if ($item->unit == 'pack')
                                        selected
                                    @endif
                                    >Pack</option>
                                    <option value="sachet" @if ($item->unit == 'sachet')
                                        selected
                                    @endif
                                    >Sachet</option>
                                    <option value="syrup" @if ($item->unit == 'syrup')
                                        selected
                                    @endif
                                    >Syrup</option>
                                    <option value="tab" @if ($item->unit == 'tab')
                                        selected
                                    @endif
                                    >Tablet</option>
                                </select>
                            </div>
                            <div>
                                <label for="size">Size (ex. "10pcs", "10cmx10cm"):</label>
                                <input class="form-control" type="text" id="size" name="size" value="{{ $item->size }}">
                            </div>
                            <div>
                                <label for="grouping">Grouping (ex. "Pack of 10s"):</label>
                                <input class="form-control" type="text" id="grouping" name="grouping" value="{{ $item->grouping }}">
                            </div>
                        </div>
                        <div class="d-none d-md-inline">
                            <button type="submit" class="btn item-btn action-btn d-none d-md-flex justify-content-between align-items-center">
                                <i class="bi-arrow-repeat" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">UPDATE<br>ITEM</h4>
                            </button>
                        </div>
                    </div>
                    <div class="form-group btn" style="background-color: red;">
                        <label for="high_warning_threshold"><b style="color: white;">Set High warning when quantity goes below</b></label>
                        <input class="form-control" type="number" min="1" step="1" id="high_warning_threshold" name="high_warning_threshold" value="{{ $item->high_warning_threshold }}"><br>
                    </div>
                    <div class="form-group btn" style="background-color: orange;">
                        <label for="mid_warning_threshold"><b style="color: white;">Set Medium warning when quantity goes below</b></label>
                        <input class="form-control" type="number" min="1" step="1" id="mid_warning_threshold" name="mid_warning_threshold" value="{{ $item->mid_warning_threshold }}"><br>
                    </div>
                    <div class="form-group btn" style="background-color: gold;">
                        <label for="low_warning_threshold"><b style="color: white;">Set Low warning when quantity goes below</b></label>
                        <input class="form-control" type="number" min="1" step="1" id="low_warning_threshold" name="low_warning_threshold" value="{{ $item->low_warning_threshold }}"><br>
                    </div>
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
                    <div class="d-md-none">
                        <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                            <i class="bi-arrow-repeat" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">UPDATE<br>ITEM</h4>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>