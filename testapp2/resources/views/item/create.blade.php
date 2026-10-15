<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Add Item
    </x-slot>
</x-head>
<body>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <div class="">
            <x-back/>
            <div class="container-md rounded-5 p-5">
                <div>
                    <h1 style="display:inline;"><b>🏥 HSU Inventory</b></h1>
                </div>
                <br>
                <div class="d-flex align-items-center">
                    <i class="bi-plus-circle"></i>
                    <span>&nbsp;</span>
                    <h4 style="display:inline; margin: 0;"><b>Creating New Item</b></h4>
                </div>
                <br>
                <form class="container-md" action="{{ route('item.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            <div class="row">
                                <div class="col"><label for="category"><b>Category:</b></label></div>
                                <div class="col"><select id="category" name="category" class="form-control" required onchange="
                                    $('#brandInput').hide();
                                    $('#brand')[0].value = '';
                                    $('#doseInput').hide();
                                    $('#dose')[0].value = '';
                                    if ($('#category')[0].value == 'drug') {
                                        $('#brandInput').show();
                                        $('label[for=\'name\']')[0].innerHTML = '<b>Generic Name:</b>';
                                    } else {
                                        $('label[for=\'name\']')[0].innerHTML = '<b>Name:</b>';
                                    }
                                    if ($('#category')[0].value != 'supplies') {
                                        $('#doseInput').show();
                                    }
                                ">
                                    <option value="">Select...</option>
                                    <option value="drug">Drug</option>
                                    <option value="topical_oral">Topical/Oral</option>
                                    <option value="supplies">Supplies</option>
                                </select></div>
                            </div>
                            <div class="row">
                                <div class="col"><label for="name"><b>Name:</b></label></div>
                                <div class="col"><input class="form-control" type="text" id="name" name="name" required></div>
                            </div>
                            <div class="row" id="brandInput">
                                <div class="col"><label for="brand"><b>Brand Name:</b></label></div>
                                <div class="col"><input class="form-control" type="text" id="brand" name="brand"></div>
                            </div>
                            <div class="row" id="doseInput">
                                <div class="col"><label for="dose"><b>Dose (ex. "10mcg"):</b></label></div>
                                <div class="col"><input class="form-control" type="text" id="dose" name="dose"></div>
                            </div>
                            <div class="row">
                                <div class="col"><label for="unit"><b>Unit:</b></label></div>
                                <div class="col"><select id="unit" name="unit" class="form-control">
                                    <option value="">Select...</option>
                                    <option value="cap">Capsule</option>
                                    <option value="pack">Pack</option>
                                    <option value="sachet">Sachet</option>
                                    <option value="syrup">Syrup</option>
                                    <option value="tab">Tablet</option>
                                </select></div>
                            </div>
                            <div class="row">
                                <div class="col"><label for="size"><b>Size (ex. "10pcs", "10cmx10cm"):</b></label></div>
                                <div class="col"><input class="form-control" type="text" id="size" name="size"></div>
                            </div>
                            <div class="row">
                                <div class="col"><label for="grouping"><b>Grouping (ex. "Pack of 10s"):</b></label></div>
                                <div class="col"><input class="form-control" type="text" id="grouping" name="grouping"></div>
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="row">
                                <div class="col"><label for="qty"><b>Beginning Inventory:</b></label></div>
                                <div class="col"><input class="form-control" type="number" min="1" step="1" id="qty" name="qty"></div>
                            </div>
                            <div class="row">
                                <div class="col"><label for="expiry_date"><b>Expiry Date:</b></label></div>
                                <div class="col"><input class="form-control" type="date" id="expiry_date" name="expiry_date"></div>
                            </div>
                        </div>
                        <input class="form-control" type="text" id="nurse" name="nurse" value="{{ Auth::user()->name . ' (' . Auth::user()->email . ')' }}" hidden>
                        {{-- <div style="flex-basis: 100%;height: 0;"></div>
                        <div class="form-group btn" style="background-color: red;">
                            <label for="high_warning_threshold"><b style="color: white;">Set High warning when quantity goes below</b></label>
                            <input class="form-control" type="number" min="1" step="1" id="high_warning_threshold" name="high_warning_threshold"><br>
                        </div>
                        <div class="form-group btn" style="background-color: orange;">
                            <label for="mid_warning_threshold"><b style="color: white;">Set Medium warning when quantity goes below</b></label>
                            <input class="form-control" type="number" min="1" step="1" id="mid_warning_threshold" name="mid_warning_threshold"><br>
                        </div>
                        <div class="form-group btn" style="background-color: gold;">
                            <label for="low_warning_threshold"><b style="color: white;">Set Low warning when quantity goes below</b></label>
                            <input class="form-control" type="number" min="1" step="1" id="low_warning_threshold" name="low_warning_threshold"><br>
                        </div> --}}
                    </div>
                    <br>
                    <br>
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary mx-2 d-flex justify-content-between align-items-center border-black" style="width: 9.5em;" href="{{ route('item.index', ['sort'=>'name']) }}">
                            <i class="bi-plus-square"></i>
                            <p style="margin:0">Add New Item</p>
                        </button>
                        <button class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 10em;" onclick="
                            $('#category')[0].value = '';
                            $('#name')[0].value = '';
                            $('#brand')[0].value = '';
                            $('#dose')[0].value = '';
                            $('#unit')[0].value = '';
                            $('#size')[0].value = '';
                            $('#grouping')[0].value = '';
                            $('#qty')[0].value = '';
                            $('#expiry_date')[0].value = '';
                        ">
                            <p style="margin:0">🗑️ Clear Progress</p>
                        </button>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#brandInput').hide()
        $('#doseInput').hide()
    </script>
</body>
</html>