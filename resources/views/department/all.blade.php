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
        HPO Departments
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="employees-table">
                <thead>
                    <tr>
                        <th>Department Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>No. of employees</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(App\Department::all() as $department)
                    <tr class="odd gradeX">
                        <td><a href="/departments/{{ $department->department_code }}">{{ $department->department_code }}</a></td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->description }}</td>
                        <td>{{ $department->employees->count() }}</td>
                        <td>
                            <a href="/departments/{{ $department->department_code }}/edit">
                                <button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button>
                            </a>
                            <a href="/departments/{{ $department->department_code }}">
                                <button class="btn btn-info btn-xs"><i class="fa fa-search"></i> View</button>
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
