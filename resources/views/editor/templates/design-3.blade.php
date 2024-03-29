@extends('layouts.dashbase')
@section('token')
    "{{ csrf_token() }}"
@endsection
@section('dashContent')
    <div id="pass_info" class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        The text you type here will not be shown on the pass, but it's needed for the notification users will see on
        their phone.
    </div>
    <div class="row" id="passEditor">
        <div class="centred block panel passPreviewer">
            <form class="front" id="bgImg" action="#" v-on:submit="createPass">
                {{--TODO - leave paintbrush commented out until styler (back of card) is finished--}}
                {{--<a class="action" id="goToSettingsPanel"><i class="fa fa-btn fa-paint-brush"></i></a>--}}
                <h1>
                    <input class="clearable hd" rows="1" placeholder="Title*" maxlength="32" required
                           v-model="passTitle"></input>
                </h1>
                <input class="clearable pd" id="file-uploader" name="passFullBG" type="hidden" data-clearable
                       role="uploadcare-uploader" data-crop="3:4" v-model="passFullBG">
                <input class="clearable pd" rows="1" id="from" name="from" placeholder="Expiry Date (Opt.)"
                       maxlength="16" v-model="passExpiry"></input>
                <textarea class="clearable pd" rows="2" placeholder="Description*" maxlength="255" required
                          v-model="passPrimary"></textarea>
                <input class="clearable pd" rows="1" placeholder="Extra Info (Opt.)" maxlength="255"
                       v-model="passSecondary"></input>
                <input class="clearable pd" rows="1" placeholder="Barcode Value" maxlength="32"
                       v-model="passBarcode"></input>
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <input type="submit" value="Save Pass" class="form-control submit-button">
                @include('global.uploadcare-3')
            </form>
            {{--TODO - back of card commented out below until back styler finished--}}
            {{--<div class="back">--}}
            {{-- <div class="btn-group theme-picker" data-toggle="buttons" align="center">--}}
            {{--<label class="btn active">--}}
            {{--<input type="radio" value="1" name="theme" v-model="passTheme" checked>Admiral--}}
            {{--</label>--}}
            {{--<label class="btn">--}}
            {{--<input type="radio" value="2" name="theme" v-model="passTheme">Bell Buoy--}}
            {{--</label>--}}
            {{--<label class="btn">--}}
            {{--<input type="radio" value="3" name="theme" v-model="passTheme">Bowline--}}
            {{--</label>--}}
            {{--</div> --}}
            {{--<input type="submit" class="edit-submit" value="Save Pass">--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4" id="result"></div>
@endsection
@include('global.vue')
@include('global.datepicker')
