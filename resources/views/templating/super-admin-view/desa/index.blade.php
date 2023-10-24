@extends('templating.components.master');

@section('css-page')
@endsection

@section('main-content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Desa</h5>

        @if(session('message'))
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                {{ session('message')['text'] }}
            </div>
        @endif

        <table id="example" class="display nowrap cell-border row-border" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Desa</th>
                    <th>Nama Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sub_districts as $item)
                    <tr>
                        <td></td>
                        <td class="text-uppercase">{{ $item->sub_district_name }}</td>
                        <td class="text-uppercase">{{ $item->district_name }}</td>
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
            ],
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
            window.location.href = '/dashboard/superadmin/desa/create';
        });
    });
</script>

@endsection