@extends('layouts.master')

@section('stylesheet')
<link href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
@stop

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		{{ $employee_shift->shift->description }}
	</div>
	<div class="panel-body">
		<form action="/employees/shift/{{ $employee_shift->id }}" method="POST">
			<input type="hidden" name="_method" value="PUT"/>
			{!! csrf_field() !!}
			<div class="form-group">
	            <label>Shifts</label>
	            <select class="form-control" name="shift_id">
	                @foreach(App\Shift::all() as $shift)
	                <option value="{{ $shift->id }}" {{ ($shift->id === $employee_shift->shift_id ? 'selected' : '') }}>{{ $shift->description.' - '.$shift->shift_from.' to '.$shift->shift_to }}</option>
	                @endforeach
	            </select>
	        </div>
	        <div class="form-group">
	            <label>Effectivity Date</label>
	        </div>
	        <div class="row">
	            <div class="col-md-6">
	                <input type="text" id="dateFrom" name="date_from" class="form-control" placeholder="Date started" value="{{ $employee_shift->date_from }}"/>
	            </div>
	            <div class="col-md-6">
	                <input type="text" id="dateTo" name="date_to" class="form-control" placeholder="Date ended" value="{{ $employee_shift->date_to }}"/>
	            </div>
	        </div>	
	        <hr>
	        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
		</form>	
	</div>
</div>
@stop

@section('script')
<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">

$('#dateFrom').datetimepicker({
    format: 'YYYY-MM-DD'
});

$('#dateTo').datetimepicker({
    format: 'YYYY-MM-DD'
});
</script>
@stop