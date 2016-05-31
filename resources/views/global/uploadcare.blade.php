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
						"_token": @yield('token'),
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