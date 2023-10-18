@extends('templating.components.master')

@section('main-content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Detail Pengguna</h5>
            <table class="table table-borderless">
                <tr>
                    <th>Nama</th>
                    <th>:</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Nik</th>
                    <th>:</th>
                    <td>{{ $user->nik }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>:</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Telephone</th>
                    <th>:</th>
                    <td>{{ $user->telephone }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <th>:</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <th>:</th>
                    <td>{{ $user->role_name }}</td>
                </tr>
            </table>

        </div>
    </div>
@endsection
@section('js-page')
   
@endsection
