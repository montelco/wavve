<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.15/vue.js"></script>
<script>
	var demo = new Vue({
		el: '#settings',
		data: {
			bizFB : '',
			bizIG : '',
			bizTW : '',
			bizWS : '',
			bizDescription : '',
			bizName: '',
			bizUsername: '',
		},
		methods: {
			createPass: function (e){
				e.preventDefault();
				$.ajax({
					url: '/update-settings',
					type: 'post',
					dataType: 'json',
					data: {
						'_token': @yield('token'),
						'facebook' : this.bizFB,
						'instagram' : this.bizIG,
						'twitter' : this.bizTW,
						'website': this.bizWS,
						'description': this.bizDescription,
						'name': this.bizName,
						'username' : this.bizUsername,
					}
					}).success(function() {
						$('#result').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Updated ' + this.passTitle + ' in your pass collection.');
                		$('#result').addClass('alert alert-success');
					}.bind(this));
			}
		}
	})
</script>