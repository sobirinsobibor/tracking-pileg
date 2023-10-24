@extends('templating.components.master');

@section('css-page')
@endsection

@section('main-content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">TPS</h5>

        @if(session('message'))
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                {{ session('message')['text'] }}
            </div>
        @endif

        <table id="example" class="display cell-border row-border" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama TPS</th>
                    <th>Alamat</th>
                    <th>Lokasi</th>
                    <th>Dapil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($voting_places as $item)
                    <tr class="text-justify" >
                        <td></td>
                        <td>{{ $item->voting_place_name }}</td>
                        <td>{{ $item->voting_place_address }}</td>
                        <td>
                           <table>
                            <tr class="my-1">
                                <th>Desa</th>
                                <td class="text-capitalize">{{ $item->sub_district_name}}</td>
                            </tr>
                            <tr class="my-1">
                                <th>Kecamatan</th>
                                <td class="text-capitalize">{{ $item->district_name }}</td>
                            </tr>
                            <tr class="my-1">
                                <th>Kota</th>
                                <td class="text-capitalize"> {{ $item->voting_place_city}}</td>
                            </tr>
                            <tr class="my-1">
                                <th>Provinsi</th>
                                <td class="text-capitalize">{{ $item->voting_place_province}}</td>
                            </tr>
                           </table>
                            
                        </td>
                        <td>{{ $item->electoral_district_name }}</td>
                        <td>
                            <a href={{ route('dashboard.superadmin.tps.show', [$item->voting_place_encrypted_id]) }} class="btn btn-primary rounded">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection


@section('js-page')
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    text:'+ Add New',
                    attr:{
                        class:'btn btn-primary',
                        id : 'btn-add-new',
                    }
                },
                'copy', 'csv', 'excel', 'pdf', 'print',
            ]
        });
        function updateRowNumbers() {
            var i = 1;
            table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, k) {
                cell.innerHTML = i++;
            });
        }
        table.on('order.dt search.dt', updateRowNumbers).draw();
        updateRowNumbers();

        $('#example td').css({
            'word-wrap': 'break-word',
            'white-space': 'normal',
            'text-align' : 'justify'
        });
    } );
</script>
<script>
    $(document).ready(function() {
        $('#btn-add-new').click(function() {
            window.location.href = '/dashboard/superadmin/tps/create';
        });
    });
</script>

@endsection