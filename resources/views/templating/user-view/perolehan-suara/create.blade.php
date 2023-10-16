@extends('templating.components.master')

@section('main-content')

<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold">Perolehan Suara {{ $voting_places->voting_place_name }} {{ $voting_places->electoral_district_name }}}</h5>
        <h5 class="card-title fw-light text-capitalize">{{ $voting_places->voting_place_address }}</h5>
        <h5 class="card-title fw-light text-capitalize  mb-4">{{ $voting_places->voting_place_sub_district }}, {{ $voting_places->voting_place_district }}, {{ $voting_places->voting_place_city }}, {{ $voting_places->voting_place_province }}</h5>

        @if(session('message'))
        <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
            {{ session('message')['text'] }}
        </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr class="mb-1">
                        <th>Nama Pengunggah</th>
                        <th>:</th>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr class="mb-1">
                        <th>NIK</th>
                        <th>:</th>
                        <td>{{ Auth::user()->nik }}</td>
                    </tr>
                    <tr class="mb-1">
                        <th>Telephone</th>
                        <th>:</th>
                        <td>{{ Auth::user()->telephone }}</td>
                    </tr>
                    
                </table>
            </div>
        </div>
        <form method="POST" action="{{ route('dashboard.user.perolehan-suara') }}">
            @csrf
            <input type="hidden" name="id_voting_place" required readonly value="{{ $voting_places->voting_place_encrypted_id }}">
            <input type="hidden" name="id_user" required readonly value="{{ Auth::user()->id }}">
            <div class="row mb-3">
                <label class="form-label">Suara Kandidat</label>
                <label for="candidate_vote_vote_count" class="col-sm-4 col-form-label">
                    {{ !empty($candidate->candidate_name) ? $candidate->candidate_name : 'Kandidat Belum Ada' }}
                </label>
               
                <div class="col-sm-8">
                <input type="hidden" name="id_candidate" required readonly value="{{ $candidate->candidate_encrypted_id }}">
                <input type="number" name="candidate_vote_vote_count" class="form-control" id="candidate_vote_vote_count" required>
                </div>
              </div>
            <div class="row">
                @foreach ($parties as $item)
                    <div class="col-md-4 mb-3">
                        <label for="total_vote_vote_count" class="form-label">{{ $item->party_name }} ({{ $item->party_acronym }})</label>
                        <input type="hidden" name="id_party[]" id="id_party" value="{{ $item->party_encrypted_id }}" readonly required>
                        <input type="number" class="form-control" id="total_vote_vote_count" name="total_vote_vote_count[]" required>
                    </div>
                @endforeach
            </div>
            <div class="row">
                @for($i=0; $i<5; $i++)
                    <div class="col-md-4 mb-3">
                        <label class="form-label">FILE</label>
                        <input type="file" class="form-control" >
                    </div>
                @endfor
            </div>
            <div style="display: flex; justify-content: flex-end;">
                @if (!empty($candidate->candidate_name))
                    <button type="submit" class="btn btn-primary">Submit</button>
                @else
                    Kandidat Belum Ada
                @endif
            </div>
            
        </form>
    </div>
</div>

@endsection