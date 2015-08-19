@extends('layouts.master')

@section('stylesheet')
<!-- DataTables CSS -->
<link href="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
@stop

@section('content')
<form action="/dtr/delete-all" method="POST">
    <input type="hidden" name="_method" value="DELETE"/>
    {!! csrf_field() !!}
    <button type="submit" id="loadingButton" data-loading-text="Clearing logs..." class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Clear logs</button>
</form>
<hr>
<div class="panel panel-default">
    <div class="panel-heading">
        Employee Daily Time Record
        <div class="pull-right">
            <div class="btn-group">
                <a href="/dtr/export">
                    <button type="button" class="btn btn-primary btn-xs">
                        <i class="fa fa-file"></i> Export DTR Report
                    </button>
                </a>
            </div>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="employees-table">
                <thead>
                    <tr>
                        <th>Employee name</th>
                        <th>Start of duty</th>
                        <th>First break</th>
                        <th>Second break</th>
                        <th>Third break</th>
                        <th>End of duty</th>
                        <th>Undertime</th>
                        <th>Late</th>
                        <th>Total Overbreak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\EmployeeDtr::with('employee')->groupBy('start_of_duty')->get() as $dtr)
                    <tr class="odd gradeX">
                        <td><a href="/employees/{{ $dtr->employee->employee_id }}">{{ $dtr->employee->first_name.' '.$dtr->employee->middle_name.' '.$dtr->employee->last_name }}</a></td>
                        <td>{{ date('M d, Y H:i:s',strtotime($dtr->start_of_duty)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->first_out)) }} to {{ date('H:i:s',strtotime($dtr->first_in)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->second_out)) }} to {{ date('H:i:s',strtotime($dtr->second_in)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->third_out)) }} to {{ date('H:i:s',strtotime($dtr->third_in)) }}</td>
                        <td>{{ date('M d, Y H:i:s',strtotime($dtr->end_of_duty)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->undertime)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->late)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->overbreak)) }}</td>
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
