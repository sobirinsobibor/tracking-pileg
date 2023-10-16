@extends('templating.components.master')

@section('main-content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Kandidat</h5>
      @if(session('message'))
      <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
          {{ session('message')['text'] }}
      </div>
      @endif

      @if($countCandidate > 0)
        <p class="mb-4">{{ $candidate->candidate_name }} </p>
      @endif
      
      @if($countCandidate < 1)
      <a href="{{ route('dashboard.superadmin.kandidat.create') }}" class="btn btn-primary" >Masukkan Data Kandidat</a>
      @endif
    </div>
</div>
@endsection
