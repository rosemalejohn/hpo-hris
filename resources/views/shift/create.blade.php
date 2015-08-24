@extends('layouts.master')

@section('stylesheet')
<link href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
@stop

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
                        <input class="form-control" name="description" placeholder="ex. Graveyard Shift">
                    </div>
                    <div class="form-group">
                        <label>Shift from</label>
                        <input type="text" class="form-control" id="startTime" name="shift_from" placeholder="Start time"/>
                    </div>
                    <div class="form-group">
                        <label>Shift to</label>
                        <input type="text" class="form-control" id="endTime" name="shift_to" placeholder="End time"/>
                    </div>
                    <div class="form-group">
                        <label>Working hours</label>
                        <input type="text" class="form-control" id="workingHours" name="working_hours" placeholder="End time"/>
                    </div>
                    <div class="form-group">
                        <label>Break</label>
                        <input type="text" class="form-control" name="break" placeholder="hh:mm"/>
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

@section('script')
<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
$(function () {
    $('#startTime').datetimepicker({
        format: 'HH:mm'
    });
    
    $('#endTime').datetimepicker({
        format: 'HH:mm'
    });

    $('#workingHours').datetimepicker({
        format: 'HH:mm'
    });
});
</script>
@stop
