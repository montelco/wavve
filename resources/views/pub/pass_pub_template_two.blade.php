@extends('pub.global.gen_layout')
@section('title')
	{{ $pass->title }}
@endsection

@section('meta_description')
	"{{ $pass->primary_field}}"
@endsection

@include('pub.global.theme-color')

@section('barcode_value')
	@if(isset($pass->barcode_value) && $pass->barcode_value != null)
		"{{ $pass->barcode_value }}";
	@endif
@endsection

@section('strip_pass_contents')
		<h1 class="d2"> {{$pass->title}} </h1>
		@if(isset($pass->expiry) && $pass->expiry != null)
			<p class="expiry">Exp: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pass->expiry)->format('D, j M Y') }}</p>
		@endif
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
		<div class="row">
			<p class="watermark col-lg-4 col-lg-offset-8">Powered by <a href="https://wavvve.io">Wavvve</a> &#0153; <img src="tpw.png" width="19" height="22"></p>
		</div>
@endsection
