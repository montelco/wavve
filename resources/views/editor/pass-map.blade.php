@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')
	<style>
		#page-wrapper{
			padding: 0px !important;
    		margin-top: -55px !important;
    	}
		.container-fluid{
			padding-left: 0px !important;
			padding-right: 0px !important;
		}
	</style>
	<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d12280.739879591261!2d-75.14870065!3d39.6905449!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1462991307145" width="100%" height="730px" frameborder="0" style="border:0" allowfullscreen></iframe>
@endsection