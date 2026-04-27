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
        <div class="row">
            <div class="col-md-12 rounded-background">
                <x-back/>
                <div class="d-flex justify-content-between">
                    <div>
                        <h1 style="display:inline;">Nurses</h1>
                        <h4 style="display:inline;">({{ $users->count() }})</h4>
                    </div>
                    @if (Auth::user()->admin)
                        <div class="d-flex justify-content-start">
                            <a class="btn item-btn action-btn d-flex justify-content-between align-items-center" href="{{ route('register') }}">
                                <i class="bi-person-plus-fill" style="font-size:3em;line-height:1em"></i>
                                <h4 style="margin:0">ADD<br>NURSE</h4>
                            </a>
                        </div>
                    @endif
                </div>
                <br>
                <table class="table">
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