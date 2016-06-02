@extends('layouts.dashbase')
@include('global.vue')

@section('token')
	"{{ csrf_token() }}"
@endsection

@section('tpID')
	"{{ $targetPass->id }}"
@endsection

@section('dashContent')
	<div class="col-md-4 col-md-offset-4" id="result"></div>
	<div class="row" id="passEditor">
        <div class="centred block panel" id="passPreviewer">
            <form class="front" id="bgImg" action="#" v-on:submit="createPass">
                <style>
                    #strip-bg-image{
                    	padding-top: 2em;
                    	padding-bottom: 2em;
                        @if(isset($targetPass->strip_background_image))
                        	background: url({{$targetPass->strip_background_image}}-/scale_crop/1080x1920/center/-/blur/45/-/quality/lightest/-/progressive/yes/) center center no-repeat;
                        @else
                        	background: #bababa;
                        @endif 
                        background-size:100% !important;
                    }
                </style>
				<h1 class="themed">
                    <input value="{{$targetPass->title}}" class="clearable hd" rows="1" placeholder="Title*" maxlength="32" required v-model="passTitle"></input>
                </h1>
                <div id="strip-bg-image">
                	<input class="clearable pd" id="file-uploader" name="passStripBG" type="hidden" data-clearable role="uploadcare-uploader" required v-model="passStripBG">
	                <textarea value="" class="clearable pd" rows="2" placeholder="Description*" maxlength="255" required v-model="passPrimary">
	                	{{$targetPass->primary_field}}
	                </textarea>
					<input @if(isset($targetPass->expiry)) value="{{$targetPass->expiry}}" @endif class="clearable pd" rows="1" placeholder="Expiry (Opt.)" maxlength="16" v-model="passExpiry"></input>
                </div>
				<div id="lower-content themed">
					<input @if(isset($targetPass->secondary_field)) value="{{$targetPass->secondary_field}}" @endif class="clearable pd" rows="1" placeholder="Extra Info (Opt.)" maxlength="512" v-model="passSecondary"></input>
	            	<input value="{{$targetPass->barcode_value}}" class="clearable pd" rows="1" placeholder="Barcode Value*" maxlength="32" required v-model="passBarcode"></input>
	            	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	            	<input type="submit" value="Save Changes" class="form-control submit-button">
				</div>
				@include('editor.existing.global.uploadcare-2')
            </form>
            <div class="back">
            	@include('global.datepicker')
                <input type="text" id="from" name="from" placeholder="Publish Time" class="time-picker-override" v-model="passPublishTime">
                <input type="submit" class="edit-submit" value="Save Preferences">
            </div>
        </div>
    </div>
@endsection
