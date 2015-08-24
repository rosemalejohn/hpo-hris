@extends('layouts.master')

@section('stylesheet')
<!-- DataTables CSS -->
<link href="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Shifts
        <div class="pull-right">
            <div class="btn-group">
                <a href="/shifts/create">
                    <button type="button" class="btn btn-danger btn-xs">
                        <i class="fa fa-plus"></i> Add new shift
                    </button>
                </a>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addShift">
                    <i class="fa fa-plus"></i> Add Employee shift
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
                        <!-- <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                        <th>Sun</th> -->
                        <th>Effective</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employee->shifts as $employee_shift)
                    <tr>
                        <td><a href="/shifts/{{ $employee_shift->id }}">{{ $employee_shift->description }}</a></td>
                        <td>{{ $employee_shift->shift_from.' to '.$employee_shift->shift_to }}</td>
                        <td>{{ $employee_shift->working_hours }}</td>
                        <td>
                            @forelse($employee_shift->pivot->employee_shift_days as $day)
                                <span>{{ strtoupper($day->day) }} </span>
                            @empty
                            <div class="alert alert-danger">No days available!</div>
                            @endforelse
                        </td>
                        <td>{{ date('M d Y', strtotime($employee_shift->pivot->date_from)).' to '.date('M d Y', strtotime($employee_shift->pivot->date_to)) }}</td>
                        <td>{{ date('M d Y', strtotime($employee_shift->created_at)) }}</td>
                        <td>
                            <a href="/employees/shift/{{ $employee_shift->pivot->id }}/edit">
                                <button class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="/employees/shift/{{ $employee_shift->pivot->id }}/delete">
                                <button class="btn btn-xs btn-danger"><i class="fa fa-remove"></i></button>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11"><div class="alert alert-success">No shift yet.</div></td>
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
                        <td>{{ $dtr->employee->first_name.' '.$dtr->employee->middle_name.' '.$dtr->employee->last_name }}</td>
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
@include('employee.partials.add_shift')

@stop

@section('script')
<!-- DataTables JavaScript -->
<script src="/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$('#employees-table').DataTable({
    responsive: true
});

$('#dateFrom').datetimepicker({
    format: 'YYYY-MM-DD'
});

$('#dateTo').datetimepicker({
    format: 'YYYY-MM-DD'
});
</script>
@stop
