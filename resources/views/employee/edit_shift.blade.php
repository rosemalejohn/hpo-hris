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
	        <br>
            <div class="form-group">
                <label>Days</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="days[]" value="mon" {{ ($employee_shift_days->contains('day', 'mon') ? 'checked': '') }}>Monday
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="days[]" value="tue" {{ ($employee_shift_days->contains('day', 'tue') ? 'checked': '') }}>Tuesday
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="days[]" value="wed" {{ ($employee_shift_days->contains('day', 'wed') ? 'checked': '') }}>Wednesday
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="days[]" value="thu" {{ ($employee_shift_days->contains('day', 'thu') ? 'checked': '') }}>Thursday
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="days[]" value="fri" {{ ($employee_shift_days->contains('day', 'fri') ? 'checked': '') }}>Friday
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="days[]" value="sat" {{ ($employee_shift_days->contains('day', 'sat') ? 'checked': '') }}>Saturday
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="days[]" value="sun" {{ ($employee_shift_days->contains('day', 'sun') ? 'checked': '') }}>Sunday
                    </label>
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