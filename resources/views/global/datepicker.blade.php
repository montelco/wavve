<link type='text/css' rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="{{ URL::to('/css/datetimepicker.css') }}">
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-timepicker-addon.min.js"></script>
<script>
	$(function() {
		$('#from').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'HH:mm:ss',
			stepHour: 1,
			stepMinute: 5,
			stepSecond: 15
		});
		$('#until').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'HH:mm:ss',
			stepHour: 1,
			stepMinute: 5,
			stepSecond: 15
		});
	});
</script>