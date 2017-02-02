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
	<div>
		{{-- <div class="row">
				<h2> {{$pass->title}} </h2>
		</div>
		<div class="row">
				<hr>
		</div>
		@if(isset($pass->expiry))
			<div class="row">
				<div class="col-md-4 col-lg-4 col-lg-offset-8 col-sm-6 col-sm-offset-6 col-xs-8 col-xs-offset-4">
					<p class="expiry">Exp: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pass->expiry)->format('D, j M Y') }}</p>
				</div>
			</div>
		@endif
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
		</div> --}}
		<div class="social-bugs">
			{{-- @if(isset($pass->user->website))
			<a target="_blank" href="http://{{  $pass->user->website }}"><img src="www.svg" height="32px"></a>
			@endif
			@if(isset($pass->user->facebook))
				<a target="_blank" href="https://facebook.com/{{  $pass->user->facebook }}"><img src="facebook.svg" height="32px"></a>
			@endif			
			@if(isset($pass->user->twitter))
				<a target="_blank" href="https://twitter.com/{{  $pass->user->twitter }}"><img src="twitter.svg" height="32px"></a>
			@endif
			@if(isset($pass->user->instagram))
				<a target="_blank" href="https://instagram.com/{{  $pass->user->instagram }}"><img src="instagram.svg" height="32px"></a>
			@endif --}}
			<p class="watermark">Powered by <a href="https://wavvve.io">Wavvve</a> &#0153; <img src="tpw.png" width="14"></p>
		</div>
	</div>
@endsection