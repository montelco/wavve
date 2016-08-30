@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
	        <h2>Activate Your Pass: {{ $pass->title }}</h2>
	    	<small>Activating your pass will put it live for everyone to see when they are near your beacon, so don't publish a work in progress.</small>
	        <hr>
			<div class="btn-group theme-picker" data-toggle="buttons" align="center">
				<label class="btn">
					<input type="radio" value=0 name="passPublishTime" v-model="passPublishTime">Unpublished
				</label>
				<label class="btn">
					<input type="radio" value=1 name="passPublishTime" v-model="passPublishTime">Published
				</label>
			</div>
		</div>
	</div>
@endsection