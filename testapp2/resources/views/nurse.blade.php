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
        <div class="row">
            <div class="col-md-12 rounded-background">
                <x-back>
                    <x-slot:route>{{ route('nurses') }}</x-slot>
                </x-back>
                <div class="container-md">
                    <h1>{{ $user->name }}</h1>
                </div>
                <hr>
                <div class="container-md d-flex justify-content-between">
                    <div>
                        <h4>Email: {{ $user->email }}</h4>
                        <h4>Role: {{ $user->admin ? 'Head Nurse' : 'Nurse' }}</h4>
                    </div>
                    
                    @if (!$user->admin)
                    <div class="d-none d-md-flex flex-column align-items-end">
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
                    @endif
                </div>

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