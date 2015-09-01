@extends('layouts.master')

@section('stylesheet')
<!-- DataTables CSS -->
<link href="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Shifts
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="employees-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Start of duty</th>
                        <th>End of duty</th>
                        <th>Working hours</th>
                        <th>Total break</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Shift::all() as $shift)
                    <tr class="odd gradeX">
                        <td><a href="/shifts/{{ $shift->id }}">{{ $shift->description }}</a></td>
                        <td>{{ $shift->shift_from }}</td>
                        <td>{{ $shift->shift_to }}</td>
                        <td>{{ $shift->working_hours }}</td>
                        <td>{{ $shift->break }}</td>
                        <td>
                            <button class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>
                            <a href="/shifts/{{ $shift->id }}/delete">
                                <button class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->
@stop

@section('script')
<!-- DataTables JavaScript -->
<script src="/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$('#employees-table').DataTable({
    responsive: true
});
</script>
@stop
