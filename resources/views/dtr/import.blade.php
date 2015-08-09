@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Import Excel File
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" action="/excel" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Choose excel file to get started</label>
                        <input type="file" name="file">
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
