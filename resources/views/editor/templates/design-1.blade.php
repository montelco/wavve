@extends('layouts.dashbase')
@include('global.vue')
@section('dashContent')
	<div class="row" id="passEditor">
		<div class="centred block panel" id="passPreviewer">
			<form class="front" id="bgImg" action="#" v-on:submit="createPass">
				<a class="action" id="goToSettingsPanel"><i class="fa fa-btn fa-cog"></i></a>
				<h1>
					<input class="clearable hd" rows="1" placeholder="Title*" maxlength="32" required v-model="passTitle"></input>
				</h1>
				<input class="clearable pd" id="file-uploader" name="passFullBG" type="hidden" data-clearable role="uploadcare-uploader" v-model="passFullBG">
				<input class="clearable pd" rows="1" placeholder="Expiry Date (Opt.)" maxlength="16" v-model="passExpiry"></input>
				<textarea class="clearable pd" rows="2" placeholder="Description*" maxlength="255" required v-model="passPrimary"></textarea>
				<input class="clearable pd" rows="1" placeholder="Extra Info (Opt.)" maxlength="255" v-model="passSecondary"></input>
				<input class="clearable pd" rows="1" placeholder="Barcode Value*" maxlength="32" required v-model="passBarcode"></input>
				<input class="clearable pd" rows="1" placeholder="Cashier Helper Text (Opt.)" maxlength="60" required v-model="passCashierHelper"></input>
				<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				<input type="submit" value="Post" class="form-control submit-button">
				<script>
					UPLOADCARE_LOCALE = "en";
					UPLOADCARE_LIVE = "false";
					UPLOADCARE_PUBLIC_KEY = "351ed2274c2d55ccfe18";
					UPLOADCARE_TABS = 'file url facebook instagram';
				</script>
				<script src="https://ucarecdn.com/widget/2.8.2/uploadcare/uploadcare.full.min.js" charset="utf-8"></script>
				<script>
					var widget = uploadcare.Widget('[role=uploadcare-uploader]');
					widget.onUploadComplete(function(info) {
						$.uploadedURL =  'https://ucarecdn.com/' + info.uuid + '/';
						$('#bgImg').append( '<style>#bgImg{background: url(' + $.uploadedURL + '-/scale_crop/1080x1920/center/-/blur/45/-/quality/lightest/-/progressive/yes/) center center no-repeat; background-size:100% !important;}</style>');
					});
					var demo = new Vue({
						el: '#passEditor',
						data: {
							passTitle : '',
							passExpiry : '',
							passPrimary : '',
							passSecondary : '',
							passBarcode : '',
							passFullBG: '',
							passCashierHelper: '',
							passPublishTime: '',
						},
						methods: {
							createPass: function (e){
								e.preventDefault();
								$.ajax({
									url: '/passes/post',
									type: 'post',
									dataType: 'json',
									data: {
										"_token": "{{ csrf_token() }}",
										'title' : this.passTitle,
										'primary_field' : this.passPrimary,
										'barcode_value' : this.passBarcode,
										'coupon_full_background_image': $.uploadedURL,
										'design_number' : '1',
									}
									}).success(function() {
										uploadcare.Widget('#file-uploader').value(null);
										$('#bgImg').css('background', '#f7f7f7');
										console.log(this.passPublishTime);
										this.passBarcode = '';
										this.passPrimary = '';
										this.passTitle = '';
										this.passFullBG = '';
										$('#result').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Successfully added ' + this.passTitle + ' to your pass collection.');
										$('#result').addClass('alert alert-success');
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
				<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
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
