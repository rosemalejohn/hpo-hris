@extends('layouts.master')

@section('stylesheet')
<link href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Import Excel File
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" action="/dtr" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Choose excel file to get started</label>
                        <input type="file" name="file">
                    </div>
                    <div class="form-group">
                        <label>Date from</label>
                        <input type="text" class="form-control" id="dateFrom" name="date_from" placeholder="Inclusive dates"/>
                    </div>
                    <div class="form-group">
                        <label>Date to</label>
                        <input type="text" class="form-control" id="dateTo" name="date_to" placeholder="Inclusive dates"/>
                    </div>
                    <hr>
                    <button type="submit" id="loadingButton" data-loading-text="Importing..." class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
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
    $('#dateFrom').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    
    $('#dateTo').datetimepicker({
        format: 'YYYY-MM-DD'
    });
});
</script>
@stop
