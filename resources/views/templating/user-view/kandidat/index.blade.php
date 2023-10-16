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

      @if($candidate)
        <p class="mb-4">{{ $candidate->candidate_name }} </p>
      @endif
    </div>
</div>
@endsection
