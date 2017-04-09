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
@section('token')
    "{{ csrf_token() }}"
@endsection
@section('strip_pass_contents')
    <div id="public-pass">
        <div class="row" id="bizname"> {{$pass->user->name}} </div>
        <h1 class="d2"> {{$pass->title}} </h1>
        @if(isset($pass->expiry) && $pass->expiry != '0000-00-00 00:00:00')
            <p class="expiry">
                Exp: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pass->expiry)->format('D, j M Y') }}</p>
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

        <div class="col-md-4 col-md-offset-4 centred promo-code promo-code--stripe">
            <div id="bcRender"></div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3 centred">
                @if(isset($pass->cashier_helper))
                    <p id="helper-text">{{  $pass->cashier_helper }}</p>
                @endif
            </div>
        </div>
        @if($pass->one_time_redemption && $pass->CantRedeem == false)
            <div class="redeem-button text-center">
                <button class="btn btn-lg" v-on:click="confirmMessage">Redeem</button>
            </div>
        @elseif($pass->one_time_redemption && $pass->CantRedeem == true)
            <div class="redeem-button text-center">
                <button class="btn btn-lg" disabled>Already Redeemed</button>
            </div>
        @endif

        <div class="social-bugs">
            <p class="watermark">Powered by <a href="https://wavvve.io">Wavvve</a> &#0153;
                <img src="tpw.png" width="19" height="22">
            </p>
        </div>
    </div>

    <script>
        new Vue({
            el: '#public-pass',
            data: {},
            methods: {
                confirmMessage: function () {
                    if (confirm("Warning: This offer may only be redeemed once. If you are not ready to redeem the offer now, press cancel. Once OK is pressed, the offer will no longer be available. If you're ready to redeem, hand your device to the cashier.")) {
                        this.redeemOneTime();
                    }
                },
                redeemOneTime: function () {
                    $.ajax({
                        url: '/redeem',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            "_token": @yield('token'),
                            "wid": "@if(isset($_COOKIE['wid'])) {{$_COOKIE['wid']}} @endif",
                            "passes_uuid": "{{$pass->uuid}}"
                        }
                    }).complete(function () {
                        $('.redeem-button').html('<button class="btn btn-lg" disabled>Already Redeemed</button>');
                    });
                }
            }
        });
    </script>
@endsection
@include('global.vue')
