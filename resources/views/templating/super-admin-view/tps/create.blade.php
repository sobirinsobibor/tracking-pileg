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
        <h5 class="card-title fw-semibold mb-4">Tambah Daerah Pilihan</h5>
        @if(session('message'))
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                {{ session('message')['text'] }}
            </div>
        @endif

        <form action="{{ route('dashboard.superadmin.tps') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="voting_place_name" class="form-label">Nama TPS</label>
                        <input type="text" class="form-control" id="voting_place_name" name="voting_place_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="voting_place_address" class="form-label">Alamat Tps</label>
                        <textarea class="form-control" id="voting_place_address" name="voting_place_address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <select aria-label="Default select example" name="id_electoral_district" required>
                            <option value="" selected>Daerah Pilihan</option>
                            @foreach ($electoral_districts as $item)
                                <option value="{{ $item->electoral_district_encrypted_id }}">{{ $item->electoral_district_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 mt-4">
                        <select name="id_sub_district" required >
                            <option value="" selected>Desa/Kelurahan, Kecamatan</option>
                            @foreach ($sub_districts as $item)
                                <option value="{{ $item->sub_district_encrypted_id }}" >
                                    {{ $item->sub_district_name }}, {{ $item->district_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="voting_place_city" class="form-label">Kabupaten/Kota</label>
                        <input type="text" class="form-control text-uppercase" id="voting_place_city" name="voting_place_city" required>
                    </div>
                    <div class="mb-3">
                        <label for="voting_place_province" class="form-label">Provinsi</label>
                        <input type="text" class="form-control text-uppercase" id="voting_place_province" name="voting_place_province" required>
                    </div>                   
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
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