@extends('layouts.master')

@section('stylesheet')
<link href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
@stop

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Add new holiday
	</div>
	<div class="panel-body">
		<div class="row">
            <div class="col-lg-6">
                <form role="form" action="/holidays" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="title" placeholder="ex. Christmas day">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" placeholder="ex. Birth of Jesus Christ"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date from</label>
                        <input type="text" class="form-control" id="startTime" name="start" placeholder="Date from"/>
                    </div>
                    <div class="form-group">
                        <label>Date to</label>
                        <input type="text" class="form-control" id="endTime" name="end" placeholder="Date to"/>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-calendar"></i> Add holiday</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
            <!-- /.col-lg-6 (nested) -->
        </div>
	</div>
</div>
@stop

@section('script')
<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
	$('#startTime').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    
    $('#endTime').datetimepicker({
        format: 'YYYY-MM-DD'
    });
</script>
@stop