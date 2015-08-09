@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Employees with {{ $shift->description }}
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Biometric ID</th>
                                <th>Name</th>
                                <th>Department Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shift->employees as $employee)
                            <tr>
                                <td>{{ $employee->employee_id }}</td>
                                <td><a href="/employees/{{ $employee->employee_id }}">{{ $employee->name }}</a></td>
                                <td><a href="/departments/{{ $employee->department->department_code }}">{{ $employee->department->name }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>

@stop
