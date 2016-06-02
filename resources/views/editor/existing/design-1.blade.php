@extends('layouts.dashbase')
@include('global.vue')
@section('dashContent')
	<div class="row" id="passEditor">
        <div class="centred block panel" id="passPreviewer">
            <form class="front" id="bgImg" action="#" v-on:submit="createPass">
                <style>
                    #bgImg{
                        @if(isset($targetPass->coupon_full_background_image))
                        	background: url({{$targetPass->coupon_full_background_image}}-/scale_crop/1080x1920/center/-/blur/45/-/quality/lightest/-/progressive/yes/) center center no-repeat;
                        @else
                        	background: #1a2128;
                        @endif 
                        background-size:100% !important;
                    }
                </style>
                <h1>
                    <input value="{{$targetPass->title}}" class="clearable pd" rows="1" placeholder="Title*" maxlength="32" required v-model="passTitle"></input>
                </h1>
                <input @if(isset($targetPass->expiry)) value="{{$targetPass->expiry}}" @endif class="clearable pd" rows="1" placeholder="Expiry Date (Opt.)" maxlength="16" v-model="passExpiry"></input>
                <input value="{{$targetPass->primary_field}}" class="clearable pd" rows="1" placeholder="Description*" maxlength="255" required v-model="passPrimary"></input>
                <input @if(isset($targetPass->secondary_field)) value="{{$targetPass->secondary_field}}" @endif class="clearable pd" rows="1" placeholder="Extra Info (Opt.)" maxlength="255" v-model="passSecondary"></input>
                <input value="{{$targetPass->barcode_value}}" class="clearable pd" rows="1" placeholder="Barcode Value*" maxlength="32" required v-model="passBarcode"></input>
                <input @if(isset($targetPass->cashier_helper)) value="{{$targetPass->cashier_helper}}" @endif class="clearable pd" rows="1" placeholder="Cashier Helper Text (Opt.)" maxlength="60" v-model="passCashierHelper"></input>
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <input type="submit" value="Save Changes" class="form-control submit-button">
                <script>
                    new Vue({
                      el: '#passEditor',
                      data: {
                        passTitle : '',
                        passPrimary : '',
                        passBarcode : '',
                        passExpiry : '',
                        passSecondary : '',
                        passCashierHelper : '',
                      },
                      methods: {
                        createPass: function (e){
                            e.preventDefault();
                            $.ajax({
                                url: '/passes/post/update',
                                type: 'post',
                                dataType: 'json',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "passID" : "{{ $targetPass->id }}", 
                                    'title' : this.passTitle,
                                    'expiry' : this.passExpiry,
                                    'primary_field' : this.passPrimary,
                                    'secondary_field' : this.passSecondary,
                                    'barcode_value' : this.passBarcode,
                                    'cashier_helper' : this.passCashierHelper,
                                    'design_number' : '1',
                                }
                            }).success(function() {
                                $('#result').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Updated ' + this.passTitle + '. Redirecting...');
                                $('#result').addClass('alert alert-success');
                                window.setTimeout(function() {
                                  window.location.href="/passes/manage";
                                }, 2000);
                            }.bind(this));
                        }
                      }
                    })
                </script>
            	<script>
                  $(document).ready(function(){
                    // set up block configuration
                    $('.block .action').click(function(){
                      $('.block').addClass('flip');
                    });
                    $('.block .edit-submit').click(function(e){
                      $('.block').removeClass('flip');
                      e.preventDefault();
                    });
                  });
                </script>
            </form>
            <div class="back">
                <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
              <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.1/jquery-ui-timepicker-addon.min.js"></script>
              <script>
              $(function() {
                $('#from').datetimepicker({
                  dateFormat: 'yy-mm-dd',
                  timeFormat: 'HH:mm:ss',
                  stepHour: 1,
                  stepMinute: 5,
                  stepSecond: 15
                });
              });
              </script>
                <input type="text" id="from" name="from" placeholder="Publish Time" class="time-picker-override" v-model="passPublishTime">
                <input type="submit" class="edit-submit" value="Save Preferences">
            </div>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4" id="result"></div>
@endsection
