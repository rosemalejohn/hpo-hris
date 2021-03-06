@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Edit Employee
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" action="/employees/{{ $employee->employee_id }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="PUT"/>

                    <div class="form-group">
                        <label>Facetime Biometric ID</label>
                        <input class="form-control" name="employee_id" placeholder="ex. 00001" value="{{ $employee->employee_id }}">
                        <p class="help-block">Generated by Facetime Biometric System</p>
                    </div>
                    <div class="form-group">
                        <label>First name</label>
                        <input class="form-control" name="first_name" placeholder="ex. Rosemale-John II" value="{{ $employee->first_name }}">
                    </div>
                    <div class="form-group">
                        <label>Middle name</label>
                        <input class="form-control" name="middle_name" placeholder="ex. Cartin" value="{{ $employee->middle_name }}">
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <input class="form-control" name="last_name" placeholder="ex. Villacorta" value="{{ $employee->last_name }}">
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" name="department_id">
                            @foreach(App\Department::all() as $department)
                            <option value="{{ $department->id }}" {{ ($employee->department_id === $department->id ? 'selected' : '') }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="active" {{ ($employee->isStatus('active') ? 'selected' : '') }}>Active</option>
                            <option value="resigned" {{ ($employee->isStatus('resigned') ? 'selected' : '') }}>Resigned</option>
                            <option value="trainee" {{ ($employee->isStatus('trainee') ? 'selected' : '') }}>Trainee</option>
                        </select>
                    </div>
                    <hr>
                    <button type="submit" id="loadingButton" data-loading-text="Updating employee..." class="btn btn-primary"><i class="fa fa-edit"></i> Update employee</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
            <!-- /.col-lg-6 (nested) -->
        </div>
        <!-- /.row (nested) -->
    </div>
    <!-- /.panel-body -->
</div>
@stop
