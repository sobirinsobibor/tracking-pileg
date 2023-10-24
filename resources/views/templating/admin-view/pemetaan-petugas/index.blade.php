@extends('templating.components.master');

@section('css-page')
@endsection

@section('main-content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Petugas</h5>

        @if(session('message'))
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                {{ session('message')['text'] }}
            </div>
        @endif

        <table id="example" class="display cell-border row-border" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nik</th>
                    <th>Telephone</th>
                    <th>Alamat</th>
                    <th></th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr class="text-justify" >
                        <th></th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->telephone }}</td>
                        @php
                            $isRegisteredToTPS = App\Models\DetailLocationOfVotingPlace::where('id_user', $item->id)->count();   
                        @endphp
                        @if( $isRegisteredToTPS > 0) {{-- kalo ada --}}
                        <td>
                            <i class="bi bi-check"style="color: green;"></i>
                        </td>
                        @else
                        <td>
                            <i class="bi bi-x" style="color: red;"></i>
                        </td>
                        @endif
                        <td>
                            <a href="/dashboard/admin/pemetaan-petugas/{{ $item->id }}/edit" class="btn btn-primary rounded">
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

@endsection