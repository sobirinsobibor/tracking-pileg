@extends('templating.components.master');

@section('css-page')
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
@endsection

@section('main-content')

        <div class="card">
          <div class="card-body">
            @if(session('message'))
                <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                    {{ session('message')['text'] }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title fw-semibold mb-4">Data Petugas</h5>
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
                    </table>
                </div>
                @php
                    $isRegisteredToTPS = App\Models\DetailLocationOfVotingPlace::where('id_user', $user->id)->count();   
                @endphp

                @if($isRegisteredToTPS > 0) {{-- kalo ada --}}
                <div class="col-md-6">
                    <h5 class="card-title fw-semibold mb-4">Data TPS</h5>
                    <table class="table table-borderless text-uppercase">
                        <tr>
                            <th>Nama TPS</th>
                            <th>:</th>
                            <td>{{ $voting_places->voting_place_name }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <td>{{ $voting_places->voting_place_address }}</td>
                        </tr>
                        <tr>
                            <th>Desa</th>
                            <th>:</th>
                            <td>{{ $voting_places->sub_district_name }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <th>:</th>
                            <td>{{ $voting_places->district_name }}</td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <th>:</th>
                            <td>{{ $voting_places->voting_place_city}}</td>
                        </tr>
                        <tr>
                            <th>Provinsi</th>
                            <th>:</th>
                            <td>{{ $voting_places->voting_place_province}}</td>
                        </tr>
                        <tr>
                            <th>Daerah Pilihan</th>
                            <th>:</th>
                            <td>{{ $voting_places->electoral_district_name}}</td>
                        </tr>
                    </table>
                </div>

                @else
                <div class="col-md-6">
                    <h5 class="card-title fw-semibold mb-4">Pilih Penempatan TPS</h5>
                    <form action="{{ route('dashboard.superadmin.pemetaan-petugas') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="id_user" name="id_user" required  value="{{ $user->id }}">
                            </div>
                            <div class="mb-3">
                                <select name="id_voting_place" required>
                                    <option value="" selected>Penempatan TPS</option>
                                    @foreach ($voting_places as $item)
                                        <option value="{{ $item->voting_place_encrypted_id }}">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>{{ $item->voting_place_name }}</td>
                                                    <td>{{ $item->electoral_district_name }}</td>
                                                </tr>
                                            </table>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                @endif

            </div>
          </div>
        </div>
@endsection

@section('js-page')

<script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>
@endsection