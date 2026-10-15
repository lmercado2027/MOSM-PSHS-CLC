<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Export
    </x-slot>
</x-head>
<body>
    <x-navbar/>
    
    <div class="container-fluid" style="padding-top: 15px;">
        <x-back/>
        <div class="container-md rounded-5 p-5">
            <div class="d-flex justify-content-between align-items-center">
                <h1 style="display:inline;"><b>🏥 HSU Inventory</b></h1>
            </div>
            <br>
            <h4 style="display:inline; margin: 0;"><b>💾 Export Items</b></h4>
            <br>
            <br>
            <form class="container-md" action="{{ route('export') }}" method="post">
                @csrf
                <h4><b>Included Categories:</b></h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="drug" name="drug" onchange="
                        if (!$('#topical_oral')[0].checked && !$('#supplies')[0].checked) {
                            $('#drug')[0].checked = true;
                        }
                    " checked>
                    <label class="form-check-label"><b>Drug</b></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="topical_oral" name="topical_oral" onchange="
                        if (!$('#drug')[0].checked && !$('#supplies')[0].checked) {
                            $('#topical_oral')[0].checked = true;
                        }
                    " checked>
                    <label class="form-check-label"><b>Topical/Oral</b></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="supplies" name="supplies" onchange="
                        if (!$('#drug')[0].checked && !$('#topical_oral')[0].checked) {
                            $('#supplies')[0].checked = true;
                        }
                    " checked>
                    <label class="form-check-label"><b>Supplies</b></label>
                </div>
                <br>
                <button class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 8.5em;">
                    <i class="bi-download"></i>
                    <p style="margin:0"> Export Table</p>
                </button>
            </form>
        </div>
    </div>
</body>