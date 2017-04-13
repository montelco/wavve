@extends('pub.global.gen_layout')
@section('title')
    {{ $pass->title }}
@endsection

@section('meta_description')
    "{{ $pass->primary_field}}"
@endsection

@include('pub.global.theme-color')

{{--@section('barcode_value')--}}
{{--@if(isset($pass->barcode_value) && $pass->barcode_value != null)--}}
{{--"{{ $pass->barcode_value }}";--}}
{{--@endif--}}
{{--@endsection--}}
@section('token')
    "{{ csrf_token() }}"
@endsection
@section('strip_pass_contents')

    <div id="public-pass">

        <h4 class="pass-title center-align"> {{$pass->title}} </h4>

        @if(isset($pass->expiry) && $pass->expiry != '0000-00-00 00:00:00')
            <p class="expiry expiry-strip pass-text">
                Exp: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pass->expiry)->format('D, j M Y') }}</p>
        @endif
        <div class="pass-strip-image strip_bg">
            <p class="pass-text">{{$pass->primary_field}}</p>
            @if(isset($pass->secondary_field))
                <p class="pass-text">{{$pass->secondary_field}}</p>
            @endif
        </div>
        <div class="pass-details pass-details-strip">

            <div id="redeem-modal" class="modal modal-fixed-footer modal-wrapper">
                <div class="modal-content">
                    <h3 class="modal-heading center-align">Offer Redemption</h3>
                    <p class="modal-warning"><strong>Warning: </strong>Once You Press Redeem You Won't Be Able To Undo
                        This. If You Are Sure
                        You Want To Redeem, Press
                        The Redeem Button Below.</p>
                    <h4 class="pass-title-modal center-align"> {{$pass->title}} </h4>
                    <div class="center-align">
                        {{--Cory TODO: hardcoded promo code below--}}
                        <p class="promo-code promo-code-modal pass-text">FREEMINIS17</p>
                    </div>
                    @if(isset($pass->expiry) && $pass->expiry != '0000-00-00 00:00:00')
                        <p class="expiry-modal center-align">
                            Expires: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pass->expiry)->format('D, M j Y') }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect btn-flat">Cancel</a>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn"
                       v-on:click="redeemOneTime">Redeem</a>
                </div>
            </div>

            @if($pass->one_time_redemption && $pass->CantRedeem == false)
                <div class="redeem-button center-align">
                    <button class="waves-effect btn-large" data-target="redeem-modal">Redeem</button>
                </div>
            @elseif($pass->one_time_redemption && $pass->CantRedeem == true)
                <div class="redeem-button center-align">
                    <button class="btn-large" disabled>Already Redeemed</button>
                </div>
            @endif

            {{--CASHIER HELPER - Possibly added back later--}}
            {{--@if(isset($pass->cashier_helper))--}}
            {{--<p id="helper-text">{{  $pass->cashier_helper }}</p>--}}
            {{--@endif--}}

            <div class="pass-bottom">
                {{--Cory TODO: hardcoded promo code below--}}
                <p class="promo-code pass-text">FREEMINIS17</p>
                <div class="social-bugs">
                    @if(isset($pass->user->website) && $pass->user->website != null)
                        <a target="_blank" href="http://{{  $pass->user->website }}"><img src="www.svg"
                                                                                          height="32px"></a>
                    @endif
                    @if(isset($pass->user->facebook) && $pass->user->facebook != null)
                        <a target="_blank" href="https://facebook.com/{{  $pass->user->facebook }}"><img
                                    src="facebook.svg"
                                    height="32px"></a>
                    @endif
                    @if(isset($pass->user->twitter) && $pass->user->twitter != null)
                        <a target="_blank" href="https://twitter.com/{{  $pass->user->twitter }}"><img src="twitter.svg"
                                                                                                       height="32px"></a>
                    @endif
                    @if(isset($pass->user->instagram )&& $pass->user->instagram != null)
                        <a target="_blank" href="https://instagram.com/{{  $pass->user->instagram }}"><img
                                    src="instagram.svg"
                                    height="32px"></a>
                    @endif
                    <p class="watermark">Powered by <a href="https://wavvve.io">Wavvve</a> &#0153; <img
                                src="tpw.png"
                                width="14"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#public-pass',
            data: {},
            methods: {
                setupModal: function () {
                    $(document).ready(function () {
                        $('#redeem-modal').modal();
                    });
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
                        Materialize.toast('Offer redeemed', 4000);
                    });
                }
            },
            created() {
                this.setupModal();
            }
        });
    </script>
@endsection
@include('global.vue')
