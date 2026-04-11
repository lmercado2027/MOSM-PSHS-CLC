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
                <div class="container-md">
                    <h4>Included Categories:</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Drug">
                        <label class="form-check-label">
                            Drug
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Topical/Oral">
                        <label class="form-check-label">
                            Topical/Oral
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Supplies">
                        <label class="form-check-label">
                            Supplies
                        </label>
                    </div>
                    <!-- TODO: add functionality -->
                    <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.index') }}">
                        <i class="bi-box-arrow-up" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">EXPORT<br>TABLE</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>