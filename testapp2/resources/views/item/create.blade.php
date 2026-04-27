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
        <div class="row">
            <div class="col-md-12 rounded-background">
                <x-back/>
                <div class="container-md">
                    <h1>Create Item</h1>
                </div>
                <hr>
                <form class="container-md" action="{{ route('item.store') }}" method="post">
                    @csrf
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="form-group">
                            <div>
                                <label for="category">Category:</label>
                                <select id="category" name="category" class="form-control" required onchange="
                                    $('#brandInput').hide();
                                    $('#brand')[0].value = '';
                                    $('#doseInput').hide();
                                    $('#dose')[0].value = '';
                                    if ($('#category')[0].value == 'drug') {
                                        $('#brandInput').show();
                                        $('label[for=\'name\']')[0].innerText = 'Generic Name:';
                                    } else {
                                        $('label[for=\'name\']')[0].innerText = 'Name:';
                                    }
                                    if ($('#category')[0].value != 'supplies') {
                                        $('#doseInput').show();
                                    }
                                ">
                                    <option value="">Select...</option>
                                    <option value="drug">Drug</option>
                                    <option value="topical_oral">Topical/Oral</option>
                                    <option value="supplies">Supplies</option>
                                </select>
                            </div>
                            <div>
                                <label for="name">Name:</label>
                                <input class="form-control" type="text" id="name" name="name" required>
                            </div>
                            <div id="brandInput">
                                <label for="brand">Brand Name:</label>
                                <input class="form-control" type="text" id="brand" name="brand">
                            </div>
                            <div id="doseInput">
                                <label for="dose">Dose (ex. "10mcg"):</label>
                                <input class="form-control" type="text" id="dose" name="dose">
                            </div>
                            <div>
                                <label for="unit">Unit:</label>
                                <select id="unit" name="unit" class="form-control">
                                    <option value="">Select...</option>
                                    <option value="cap">Capsule</option>
                                    <option value="pack">Pack</option>
                                    <option value="sachet">Sachet</option>
                                    <option value="syrup">Syrup</option>
                                    <option value="tab">Tablet</option>
                                </select>
                            </div>
                            <div>
                                <label for="size">Size (ex. "10pcs", "10cmx10cm"):</label>
                                <input class="form-control" type="text" id="size" name="size">
                            </div>
                            <div>
                                <label for="grouping">Grouping (ex. "Pack of 10s"):</label>
                                <input class="form-control" type="text" id="grouping" name="grouping">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="d-none d-md-inline">
                            <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                                <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">CREATE<br>ITEM</h4>
                            </button>
                        </div>
                        <div style="flex-basis: 100%;height: 0;"></div>
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
                        </div>
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

                    <div class="d-md-none">
                        <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                            <i class="bi-pencil-square" style="font-size:3em;line-height:1em"></i>
                            <h4 style="margin:0">CREATE<br>ITEM</h4>
                        </button>
                    </div>
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