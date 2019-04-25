@extends('layouts.master', ['body_class' => 'schedule'])
@section('css')

@endsection
@section('content')
<section id="schedule">
	<h1 class="section-title">AGENDA</h1>
	<div class="center-section">
		<div class="schedule-container">
			@foreach($schedules as $schedule)
			<div class="col-6 col-sm-3">
				<div class="schedule-item">
					<div class="schedule-date-day">
						<?php							
						$date = Carbon::createFromTimeStamp(strtotime($schedule->event_date));
						$day = $date->formatLocalized('%d');
						echo $day;
						?>
					</div>
					<div class="schedule-date-month">
						<?php
						$mesos = array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Setembre","Octubre","Novembre","Decembre");
						$date = Carbon::createFromTimeStamp(strtotime($schedule->event_date));
						$month = $date->month;
						$year = $date->year;
						echo $mesos[$month-1].' '.$year;
						?>
					</div>
					<div class="schedule-date-event">
						{{$schedule->event}}
					</div>
					<div class="schedule-date-place">
						{{$schedule->location}}
					</div>
					<div class="schedule-date-time">
						<?php 
						$date = Carbon::createFromTimeStamp(strtotime($schedule->event_time));
						$h = $date->hour;
						$m = $date->minute;
						echo $h.':'.$m;
						?>
					</div>
				</div>
			</div>			
			@endforeach			
		</div>
	</section>
	@endsection
	@section('js')

	@endsection