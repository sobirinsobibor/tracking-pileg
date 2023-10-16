@extends('templating.components.master');

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
                        <select class="form-select" aria-label="Default select example" name="id_electoral_district" required>
                            <option value="" selected>Daerah Pilihan</option>
                            @foreach ($electoral_districts as $item)
                                <option value="{{ $item->electoral_district_encrypted_id }}">{{ $item->electoral_district_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="voting_place_sub_district" class="form-label">Desa/Kelurahan</label>
                        <input type="text" class="form-control text-uppercase" id="voting_place_sub_district" name="voting_place_sub_district" required>
                    </div>
                    <div class="mb-3">
                        <label for="voting_place_district" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control text-uppercase" id="voting_place_district" name="voting_place_district" required>
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

<script>
    var textarea = document.getElementById('electoral_district_description');
    var charCount = document.getElementById('charCount');

    textarea.addEventListener('input', function() {
        var charLength = this.value.length; 
        charCount.textContent = charLength + '/200 karakter'; 
        if (charLength > 200) {
            this.value = this.value.substring(0, 200); 
        }
    });
</script>


@endsection