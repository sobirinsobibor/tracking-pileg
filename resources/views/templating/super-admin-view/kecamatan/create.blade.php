@extends('templating.components.master');

@section('main-content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Masukkan Data Kecamatan</h5>
        @if(session('message'))
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                {{ session('message')['text'] }}
            </div>
        @endif

        <form action="{{ route('dashboard.superadmin.kecamatan') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="district_name" class="form-label">Nama Kecamatan</label>
                        <input type="text" class="form-control text-uppercase" id="district_name" name="district_name" required>
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



@endsection