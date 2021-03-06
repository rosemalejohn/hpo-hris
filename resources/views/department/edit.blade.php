@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Edit "<strong>{{ $department->name }}</strong>" department
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" action="/departments/{{ $department->department_code }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="PUT"/>
                    <div class="form-group">
                        <label>Department Code</label>
                        <input class="form-control" name="department_code" placeholder="ex. SysAd" value="{{ $department->department_code }}">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name" placeholder="ex. System Administrator" value="{{ $department->name }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="2" name="description" placeholder="ex. Maintains technical problems">{{ $department->description }}</textarea>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update department</button>
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
