@extends('templating.components.master');
@section('main-content')

@if(Auth::user()->id_role === 1)

<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Selamat Datang {{ Auth::user()->name }}</h5>
    </div>
</div>


@elseif(Auth::user()->id_role === 2)
   
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Selamat Datang {{ Auth::user()->name }}</h5>
    </div>
</div>


@elseif(Auth::user()->id_role === 3)
@php
    $isRegisteredToTPS = App\Models\DetailLocationOfVotingPlace::where('id_user', Auth::user()->id)->count();
@endphp
    @if( $isRegisteredToTPS > 0) {{-- kl sudah ada tpsnya  --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Selamat Datang {{ Auth::user()->name }}</h5>
                </div>
            </div>
    @else
    
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Anda Belum Terdaftar Dalam TPS Manapun, Silakan Hubungi Admin</h5>
                    
                </div>
            </div>
    @endif
@endif
@endsection

