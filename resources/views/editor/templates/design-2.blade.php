@extends('layouts.dashbase')
@section('token')
  "{{ csrf_token() }}"
@endsection
@include('pass-style.d2')
@section('dashContent')
	<div class="row" id="passEditor">
        <div class="centred block panel passPreviewer">
            <form class="front" id="bg" action="#" v-on:submit="createPass">
            	{{--<a class="action" id="goToSettingsPanel"><i class="fa fa-btn fa-paint-brush"></i></a>--}}
                <h1>
                    <input class="clearable hd" rows="1" placeholder="Title*" maxlength="32" required v-model="passTitle"></input>
                </h1>
                <div id="strip-bg-image">
                	<input class="clearable pd" id="file-uploader" name="passStripBG" type="hidden" data-clearable role="uploadcare-uploader" data-crop="3:4" v-model="passStripBG">
	                <textarea class="clearable pd white-override" rows="2" placeholder="Description*" maxlength="255" required v-model="passPrimary"></textarea>
                    <input type="text" id="from" name="from" placeholder="Expiry (Opt.)" class="time-picker-override white-override" v-model="passExpiry">
                </div>
				<div id="lower-content">
					<input class="clearable pd" rows="1" placeholder="Extra Info (Opt.)" maxlength="512" v-model="passSecondary"></textarea>
	            	<input class="clearable pd" rows="1" placeholder="Barcode Value" maxlength="32" v-model="passBarcode"></input>
                    <div class="one-time">
                        <label for="checkbox" class="one-time__label">One Time Redemption:<span v-if="oneTimeRedemption"> On</span><span v-else> Off</span></label>
                        <label class="switch-light switch-material" onclick="">
                            <input
                                    type="checkbox"
                                    v-model="oneTimeRedemption">
                            <span aria-hidden="true">
                            <span>Off</span>
                            <span>On</span>
                            <a class="focus-override"></a>
                        </span>
                        </label>
                    </div>
	            	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	            	<input type="submit" value="Save Pass" class="form-control submit-button">
				</div>
				@include('global.uploadcare-2')
            </form>
            <div class="back">
                <input type="submit" class="edit-submit" value="Save Changes">
            </div>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4" id="result"></div>
@endsection
@include('global.vue')
@include('global.datepicker')
