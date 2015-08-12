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
        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-xs">
                    <i class="fa fa-plus"></i> Add shift
                </button>
            </div>
        </div>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Shift description</th>
                        <th>Time</th>
                        <th>Working hours</th>
                        <th>Days</th>
                        <th>Effective</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employee->employee_shifts()->orderBy('date_from', 'desc')->get() as $employee_shift)
                    <tr>
                        <td><a href="/shifts/{{ $employee_shift->shift->id }}">{{ $employee_shift->shift->description }}</a></td>
                        <td>{{ $employee_shift->shift->shift_from.' to '.$employee_shift->shift->shift_to }}</td>
                        <td>{{ $employee_shift->shift->working_hours }}</td>
                        <td>
                            @foreach($employee_shift->employee_shift_days as $day)
                            <span>{{ strtoupper($day->day).' ' }}</span>
                            @endforeach
                        </td>
                        <td>{{ date('M d Y', strtotime($employee_shift->date_from)).' to '.date('M d Y', strtotime($employee_shift->date_to)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5"><div class="alert alert-success">No shift yet.</div></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->
<div class="panel panel-default">
    <div class="panel-heading">
        Employee Daily Time Record
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee->employee_dtrs as $dtr)
                    <tr class="odd gradeX">
                        <td>{{ $dtr->employee->name }}</td>
                        <td>{{ date('M d, Y H:i:s',strtotime($dtr->start_of_duty)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->first_out)) }} to {{ date('H:i:s',strtotime($dtr->first_in)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->second_out)) }} to {{ date('H:i:s',strtotime($dtr->second_in)) }}</td>
                        <td>{{ date('H:i:s',strtotime($dtr->third_out)) }} to {{ date('H:i:s',strtotime($dtr->third_in)) }}</td>
                        <td>{{ date('M d, Y H:i:s',strtotime($dtr->end_of_duty)) }}</td>
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
