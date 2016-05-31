@extends('pub.global.gen_layout')
@section('title')
	{{ $pass->title }}
@endsection

@section('meta_description')
	"{{ $pass->primary_field}}"
@endsection

@include('pub.global.theme-color')

@section('barcode_value')
	"{{ $pass->barcode_value }}";
@endsection

@section('strip_pass_contents')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<h1> {{$pass->title}} </h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<hr>
			</div>
		</div>
		@if(isset($pass->expiry))
			<div class="row">
				<div class="col-md-2 col-md-offset-10 col-lg-2 col-lg-offset-10 col-sm-5 col-sm-offset-7 col-xs-5 col-xs-offset-7">
					<p class="expiry">Exp: {{ $pass->expiry }}</p>
				</div>
			</div>
		@endif
	</div>

		@if(isset($pass->strip_background_image))
			<div class="jumbotron strip_bg">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-xs-6">
							<p class="field primary">{{$pass->primary_field}}</p>
						</div>
						@if(isset($pass->secondary_field))
							<div class="col-md-4 col-md-offset-4 col-xs-5 col-xs-offset-1">
								<p class="secondary field">{{$pass->secondary_field}}</p>
							</div>
						@endif
					</div>
				</div>
			</div>
		@else
	<div class="container">
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<p class="field primary">{{$pass->primary_field}}</p>
					</div>
					@if(isset($pass->secondary_field))
					<div class="col-md-4 col-md-offset-4 col-xs-5 col-xs-offset-1">
						<p class="secondary field">{{$pass->secondary_field}}</p>
					</div>
					@endif
				</div>
		@endif
		<div class="row">
			<div class="col-md-4 col-md-offset-4 centred">
				<div id="bcRender"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3 centred">
				@if(isset($pass->cashier_helper))
					<p id="helper-text">{{  $pass->cashier_helper }}</p>
				@endif
			</div>
		</div>
	</div>
@endsection
