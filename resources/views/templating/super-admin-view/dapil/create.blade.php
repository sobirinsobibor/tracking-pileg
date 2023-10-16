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

        <form action="{{ route('dashboard.superadmin.dapil') }}" method="post">
            @csrf
            <div class="mb-3">
              <label for="electoral_district_name" class="form-label">Nama Daerah Pilihan</label>
              <input type="text" class="form-control" id="electoral_district_name" name="electoral_district_name">
            </div>
            <div class="mb-3">
              <label for="electoral_district_description" class="form-label">Deskripsi Daerah Pilihan</label>
              <textarea class="form-control" id="electoral_district_description" rows="5" name="electoral_district_description"></textarea>
              <p id="charCount">0/200 karakter</p>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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