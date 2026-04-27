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
        <div class="row">
            <div class="col-md-12 rounded-background">
                <x-back/>
                <div class="container-md">
                    <h1>Export Inventory</h1>
                </div>
                <hr>
                <form class="container-md" action="{{ route('export') }}" method="post">
                    @csrf
                    <h4>Included Categories:</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="drug" name="drug" onchange="
                            if (!$('#topical_oral')[0].checked && !$('#supplies')[0].checked) {
                                $('#drug')[0].checked = true;
                            }
                        " checked>
                        <label class="form-check-label">Drug</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="topical_oral" name="topical_oral" onchange="
                            if (!$('#drug')[0].checked && !$('#supplies')[0].checked) {
                                $('#topical_oral')[0].checked = true;
                            }
                        " checked>
                        <label class="form-check-label">Topical/Oral</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="supplies" name="supplies" onchange="
                            if (!$('#drug')[0].checked && !$('#topical_oral')[0].checked) {
                                $('#supplies')[0].checked = true;
                            }
                        " checked>
                        <label class="form-check-label">Supplies</label>
                    </div>
                    <br>
                    <button type="submit" class="btn item-btn action-btn d-flex justify-content-between align-items-center">
                        <i class="bi-box-arrow-up" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">EXPORT<br>TABLE</h4>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>