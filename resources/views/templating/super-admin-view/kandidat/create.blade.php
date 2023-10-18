@extends('templating.components.master');

@section('main-content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Masukkan Data Kandidat</h5>
        @if(session('message'))
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                {{ session('message')['text'] }}
            </div>
        @endif

        <form action="{{ route('dashboard.superadmin.kandidat') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="candidate_name" class="form-label">Nama Kandidat</label>
                        <input type="text" class="form-control" id="candidate_name" name="candidate_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="candidate_gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" aria-label="Default select example" name="candidate_gender" required>
                            <option value="" selected>--pilih opsi--</option>
                            <option value="1" >Laki-Laki</option>
                            <option value="0" >Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="candidate_address" class="form-label">Kota Tempat Tinggal</label>
                        <input type="text " class="form-control text-uppercase" id="candidate_address" name="candidate_address" required>
                    </div>
                    <div style="display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
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