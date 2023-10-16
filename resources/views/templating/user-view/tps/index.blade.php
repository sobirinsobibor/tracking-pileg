@extends('templating.components.master');

@section('css-page')
@endsection

@section('main-content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <h5 class="card-title fw-semibold mb-4">Daerah Pilihan</h5>
            <table class="table table-borderless">
                <tr>
                    <th>
                        {{ $DetailLocationOfVotingPlace->electoral_district_name}}
                    </th>
                </tr>
                <tr>
                    <td>
                        {{ $DetailLocationOfVotingPlace->electoral_district_description}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <h5 class="card-title fw-semibold mb-4">TPS</h5>
            <div class="col md-6">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama TPS</th>
                        <th>:</th>
                        <td class="text-capitalize">{{ $DetailLocationOfVotingPlace->voting_place_name }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td class="text-capitalize">{{ $DetailLocationOfVotingPlace->voting_place_address }}</td>
                    </tr>
                    <tr>
                        <th>Desa</th>
                        <th>:</th>
                        <td class="text-capitalize">{{ $DetailLocationOfVotingPlace->voting_place_sub_district }}</td>
                    </tr>        
                </table>
            </div>
            <div class="col md-6">
                <table  class="table table-borderless">
                    <tr>
                        <th>Kecamatan</th>
                        <th>:</th>
                        <td class="text-capitalize">{{ $DetailLocationOfVotingPlace->voting_place_district }}</td>
                    </tr>
                    <tr>
                        <th>Kota</th>
                        <th>:</th>
                        <td class="text-capitalize">{{ $DetailLocationOfVotingPlace->voting_place_city}}</td>
                    </tr>
                    <tr>
                        <th>Provinsi</th>
                        <th>:</th>
                        <td class="text-capitalize">{{ $DetailLocationOfVotingPlace->voting_place_province}}</td>
                    </tr>        
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js-page')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
               
                'copy', 'csv', 'excel', 'pdf', 'print',
            ]
        });
        $('#example td').css({
            'word-wrap': 'break-word',
            'white-space': 'normal',
            'text-align' : 'justify'
        });
    } );
</script>

@endsection