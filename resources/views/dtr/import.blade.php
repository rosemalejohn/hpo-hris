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
        <div class="alert alert-info">
            <i class="fa fa-info fa-lg"></i> <strong> Remarks: </strong> If there are changes in employee shifts, you need to clear the DTR logs and import the excel file again for accurate results.
        </div>
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
                        <input type="text" class="form-control" id="dateFrom" name="date_from" placeholder="Inclusive dates" value="{{ old('date_from') }}"/>
                    </div>
                    <div class="form-group">
                        <label>Date to</label>
                        <input type="text" class="form-control" id="dateTo" name="date_to" placeholder="Inclusive dates" value="{{ old('date_to') }}"/>
                    </div>
                    <hr>
                    <button type="submit" id="loadingButton" data-loading-text="Importing... This might take a while. Please be patient." class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
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
