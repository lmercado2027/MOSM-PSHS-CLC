<!DOCTYPE html>
<html lang="en">
<x-head>
    <x-slot:title>
        Clinic: Nurse List
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
            <div class="d-flex justify-content-between">
                <h4 style="display:inline; margin: 0;"><b>👨🏻‍⚕️👩🏻‍⚕️ Nurse List</b></h4>
                @if (Auth::user()->admin)
                <div class="d-flex justify-content-start">
                    <a class="btn item-btn d-flex justify-content-between align-items-center border-black" style="width: 8em;" href="{{ route('register') }}">
                        <i class="bi-person-plus-fill"></i>
                        <p style="margin:0">Add Nurse</p>
                    </a>
                </div>
                @endif
            </div>
            <br>
            <div style="border: 0.25em solid; border-radius: 0.25em;">
                <table class="table m-0">
                    <thead>
                        <th scope="col" style="padding: .75em 1.5em;">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </thead>
                    <tbody>
                        @foreach ($users->sortBy('name') as $user)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('nurse', ['id' => $user->id]) }}" class="btn item-btn" role="button">
                                        {{ $user->name }}
                                    </a>
                                </th>
                                <td style="vertical-align: middle;">
                                    {{ $user->email }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ $user->admin ? 'Head Nurse' : 'Nurse' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>