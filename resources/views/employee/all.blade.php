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
        HPO List of Employees
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="employees-table">
                <thead>
                    <tr>
                        <th>Biometric ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Employee::all() as $employee)
                    <tr class="odd gradeX">
                        <td><a href="/employees/{{ $employee->employee_id }}">{{ $employee->employee_id }}</a></td>
                        <td>{{ $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name }}</td>
                        <td>{{ $employee->department->name }}</td>
                        <td>
                            <a href="/employees/{{ $employee->employee_id }}/edit">
                                <button class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Update</button>
                            </a>
                            <a href="/employees/{{ $employee->employee_id }}">
                                <button class="btn btn-xs btn-info"><i class="fa fa-search"></i> View Info</button>
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
