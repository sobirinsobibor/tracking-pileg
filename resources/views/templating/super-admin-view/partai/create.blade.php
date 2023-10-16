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

        <form action="{{ route('dashboard.superadmin.partai') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="party_name" class="form-label">Nama Partai</label>
                        <input type="text" class="form-control" id="party_name" name="party_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="party_acronym" class="form-label">Akronim Partai</label>
                        <input type="text" class="form-control" id="party_acronym" name="party_acronym" required>
                    </div>
                    <div style="display: flex; justify-content: flex-start;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <div class="col-md-6">
                    
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