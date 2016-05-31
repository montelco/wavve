@extends('layouts.dashbase')
@include('global.vue')
@section('dashContent')
	<div class="row" id="passEditor">
        <div class="centred block panel" id="passPreviewer">
            <a class="action" id="goToSettingsPanel"><i class="fa fa-btn fa-cog"></i></a>
            <form class="front" id="bgImg" action="#" v-on:submit="createPass">
                <style>
                    #strip-bg-image{
                        @if(isset($targetPass->strip_background_image))
                        	background: url({{$targetPass->strip_background_image}}-/scale_crop/1080x1920/center/-/blur/45/-/quality/lightest/-/progressive/yes/) center center no-repeat;
                        @else
                        	background: #bababa;
                        @endif 
                        background-size:100% !important;
                    }
                </style>
				<h1>
                    <input value="{{$targetPass->title}}" class="clearable hd" rows="1" placeholder="Title*" maxlength="32" required v-model="passTitle"></input>
                </h1>
                <div id="strip-bg-image">
                	<input class="clearable pd" id="file-uploader" name="passStripBG" type="hidden" data-clearable role="uploadcare-uploader" required v-model="passStripBG">
	                <input value="{{$targetPass->primary_field}}" class="clearable pd" rows="2" placeholder="Description*" maxlength="255" required v-model="passPrimary"></input>
					<input @if(isset($targetPass->expiry)) value="{{$targetPass->expiry}}" @endif class="clearable pd" rows="1" placeholder="Expiry (Opt.)" maxlength="16" v-model="passExpiry"></input>
                </div>
				<div id="lower-content">
					<input @if(isset($targetPass->secondary_field)) value="{{$targetPass->secondary_field}}" @endif class="clearable pd" rows="1" placeholder="Extra Info (Opt.)" maxlength="512" v-model="passSecondary"></input>
	            	<input value="{{$targetPass->barcode_value}}" class="clearable pd" rows="1" placeholder="Barcode Value*" maxlength="32" required v-model="passBarcode"></input>
	            	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
	            	<input type="submit" value="Post" class="form-control submit-button">
				</div>
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
                                $('#result').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Updated ' + this.passTitle + ' in your pass collection.');
                                $('#result').addClass('alert alert-success');
                                this.passBarcode = '';
                                this.passPrimary = '';
                                this.passTitle = '';
                                this.passCashierHelper = '';
                                this.passSecondary = '';
                                this.passExpiry = '';
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
                <input type="submit" class="edit-submit" value="Save Changes">
            </div>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4" id="result"></div>
@endsection