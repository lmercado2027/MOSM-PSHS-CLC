<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Nurse Details
    </x-slot>
</x-head>
<body>
    <x-navbar/>

    <div class="container-fluid" style="padding-top: 15px;">
        <x-back>
            <x-slot:route>{{ route('nurses') }}</x-slot>
        </x-back>
            <div class="container-md rounded-5 p-5">
                <div class="container-md">
                    <h1><b>{{ $user->name }}</b></h1>
                </div>
                <div class="container-md d-flex justify-content-between">
                    <div>
                        <h4>Email: {{ $user->email }}</h4>
                        <h4>Role: {{ $user->admin ? 'Head Nurse' : 'Nurse' }}</h4>
                    </div>
                </div>
                @if (!$user->admin)
                    <div class="d-flex justify-content-start">
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 10.5em;" href="{{ route('promote', ['id' => $user->id]) }}"  onclick="return confirm('This action will revoke your status as the Head Nurse and cannot be reversed. Are you sure you want to proceed?')"">
                            <i class="bi-person-fill-up"></i>
                            <p style="margin:0">Promote Nurse</p>
                        </a>
                        <br>
                        <a class="btn item-btn mx-2 d-flex justify-content-between align-items-center border-black" style="width: 10em;" href="{{ route('unregister', ['id' => $user->id]) }}"  onclick="return confirm('Are you sure you want to un-register this nurse?')">
                            <i class="bi-person-fill-x"></i>
                            <p style="margin:0">Remove Nurse</p>
                        </a>
                    </div>
                @endif

                <div class="container-md d-flex justify-content-between d-md-none">
                    <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('promote', ['id' => $user->id]) }}"  onclick="return confirm('This action will revoke your status as the Head Nurse and cannot be reversed. Are you sure you want to proceed?')" style="width: 12.5em;">
                        <i class="bi-person-fill-up" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">PROMOTE<br>NURSE</h4>
                    </a>
                    <br>
                    <a type="button" class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('unregister', ['id' => $user->id]) }}"  onclick="return confirm('Are you sure you want to un-register this nurse?')" style="width: 12em;">
                        <i class="bi-person-fill-x" style="font-size:3em;line-height:1em"></i>
                        <h4 style="margin:0">REMOVE<br>NURSE</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>