<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script>
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
						
					}.bind(this));
			}
		}
	})
</script> -->