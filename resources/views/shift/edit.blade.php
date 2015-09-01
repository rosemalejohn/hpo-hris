@extends('layouts.master')

@section('stylesheet')
<link href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Update shift "<strong>{{ $shift->description }}</strong>"
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" action="/shifts/{{ $shift->id }}" method="POST">
                    <input type="hidden" name="_method" value="PUT"/>
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" name="description" placeholder="ex. Graveyard Shift" value="{{ $shift->description }}">
                    </div>
                    <div class="form-group">
                        <label>Shift from</label>
                        <input type="text" class="form-control" id="startTime" name="shift_from" placeholder="Start time" value="{{ $shift->shift_from }}"/>
                    </div>
                    <div class="form-group">
                        <label>Shift to</label>
                        <input type="text" class="form-control" id="endTime" name="shift_to" placeholder="End time" value="{{ $shift->shift_to }}"/>
                    </div>
                    <div class="form-group">
                        <label>Working hours</label>
                        <input type="text" class="form-control" id="workingHours" name="working_hours" placeholder="hh:mm:ss" value="{{ $shift->working_hours }}"/>
                    </div>
                    <div class="form-group">
                        <label>Break</label>
                        <input type="text" class="form-control" id="break" name="break" placeholder="hh:mm:ss" value="{{ $shift->break }}"/>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-clock-o"></i> Update shift</button>
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

@section('script')
<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/bower_components/jquery.maskedinput/dist/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
$(function () {
    $('#startTime').datetimepicker({
        format: 'HH:mm'
    });
    
    $('#endTime').datetimepicker({
        format: 'HH:mm'
    });

    $('#workingHours').mask("99:99:99");

    $('#break').mask("99:99:99");
});
</script>
@stop
