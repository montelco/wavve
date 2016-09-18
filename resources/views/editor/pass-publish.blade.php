@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')
@section('token')
	"{{ csrf_token() }}"
@endsection
@section('dashContent')
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
	        <h2>Activate Your Pass: {{ $pass->title }}</h2>
	    	<small>Activating your pass will put it live for everyone to see when they are near your beacon, so don't publish a work in progress. That'd be embarrassing!</small>
	        <hr>
			<form id="passPublisher" action="#" v-on:submit="changeActivePass">
				<div class="btn-group theme-picker" align="center">
					<label class="btn">
						<input type="radio" value=0 v-model="published">Inactive
					</label>
					<label class="btn">
						<input type="radio" value=1 v-model="published">Active
					</label>
				</div>
				<div>
					<input type="submit" class="edit-submit" value="Save Changes To Pass">
				</div>
			</form>
			@include('global.activator')
		</div>
	</div>
@endsection
@include('global.vue-min')