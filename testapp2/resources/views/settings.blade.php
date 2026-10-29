<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Settings
    </x-slot>
</x-head>
<body>
    <style>
        .action-btn {
            width: 13em;
        }
    </style>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <x-back/>
            <div class="container-md rounded-5 p-5">
                <div>
                    <h1 style="display:inline;"><b>🏥 Heath Services Unit - Inventory</b></h1>
                </div>
                <br>
                <div class="d-flex align-items-center">
                    <i class="bi-gear-fill"></i>
                    <span>&nbsp;</span>
                    <h4 style="display:inline; margin: 0;"><b>Settings</b></h4>
                </div>
                <hr>
                <div>
                    <h2>Account</h2>
                    <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 11em;" href="{{ route('password.request') }}">
                        <i class="bi-unlock2-fill"></i>
                        <p style="margin:0">Change Password</p>
                    </a>
                    {{-- <br>
                    <h2>Expiry Warnings</h2>
                    <br>
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="form-group btn d-flex align-items-center" style="background-color: red;color: white;">
                            <b>Set High warning when item/s expire in </b>
                            <input class="form-control" type="number" min="1" step="1" id="high_warning_threshold" name="high_warning_threshold" style="width: 4em;margin: 0em 0.5em;">
                            <b> days</b>
                        </div>
                        <div class="form-group btn d-flex align-items-center" style="background-color: orange;color: white;">
                            <b>Set Medium warning when item/s expire in </b>
                            <input class="form-control" type="number" min="1" step="1" id="mid_warning_threshold" name="mid_warning_threshold" style="width: 4em;margin: 0em 0.5em;">
                            <b> days</b>
                        </div>
                        <div class="form-group btn d-flex align-items-center" style="background-color: gold;color: white;">
                            <b>Set Low warning when item/s expire in </b>
                            <input class="form-control" type="number" min="1" step="1" id="low_warning_threshold" name="low_warning_threshold" style="width: 4em;margin: 0em 0.5em;">
                            <b> days</b>
                        </div>
                    </div>
                    <!-- TODO: add functionality -->
                    <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('item.index') }}">
                        <i class="bi-check2-circle" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">CONFIRM<br>SETTINGS</h4>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</body>