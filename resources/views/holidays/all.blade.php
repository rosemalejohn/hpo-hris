@extends('layouts.master')

@section('stylesheet')
<link rel="stylesheet" type="text/css" href="/bower_components/fullcalendar/dist/fullcalendar.min.css">
@stop

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		List of Holidays
	</div>
	<div class="panel-body">
		<div class="alert alert-info">
		    <i class="fa fa-info fa-lg"></i> <strong> Additional info: </strong> Click the event to update.
		</div>
		<div id="calendar"></div>
	</div>
</div>
@stop

@section('script')
<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript" src="/bower_components/bootbox.js/bootbox.js"></script>
<script>
	$('#calendar').fullCalendar({
        eventSources: [{
        	url: '/api/holidays',
        	type: 'GET'
        }],
        eventClick: function (holiday) {
            editHoliday(holiday);
        }
    });

	function editHoliday(holiday) 
	{
		$.get('/holidays/'+holiday.id+'/edit', function(data){
			bootbox.dialog({
				title: holiday.title,
				message: data
			})
		});
	}

	function deleteHoliday(holidayID)
	{
		$.get('api/holidays/'+holidayID+'/delete', function(data){
			bootbox.alert("Holiday successfully deleted!");
			location.reload();
		});
	}
</script>
@stop