<script>
	Vue.directive('radio', {
	  twoWay: true,
	  bind: function() {
	      var self = this;
	      var btns = $(self.el).find('.btn');
	      btns.each(function() {
	          $(this).on('click', function() {
	              var v = $(this).find('input').get(0).value
	              self.set(v);
	          })
	      });
	  },
	  update: function() {
	      var value = this._watcher.value;
	      if (value) {
	          this.set(value);
	          var btns = $(this.el).find('.btn')
	          btns.each(function() {
	              $(this).removeClass('active');
	              var v = $(this).find('input').get(0).value;

	              if (v === value) {
	                  $(this).addClass('active');
	              }
	          });
	      } else {
	          var input = $(this.el).find('.active input').get(0);
	          if (input) {
	              this.set(input.value);
	          }
	      }
	  }
	})
	var app = new Vue({
		el: '#passPublisher',
		data: {
			published : '',
		},
		methods: {
			changeActivePass: function (e){
				e.preventDefault();
				$.ajax({
					url: '/passes/publish/{{ $pass->id }}',
					type: 'post',
					dataType: 'json',
					data: {
						"_token": @yield('token'),
						"published" : this.published,
					}
					}).success(function() {
						window.location="/passes/manage";
					}.bind(this));
			}
		}
	})
</script>