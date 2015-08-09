@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        New shift
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" action="/shifts" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" name="employee_id" placeholder="ex. Graveyard Shift" value="{{ old('employee_id') }}">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-clock-o"></i> Add shift</button>
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
