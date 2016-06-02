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
                    "_token": @yield('token'),
                    "passID" : @yield('tpID'), 
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
                $('#result').addClass('alert alert-success overlayed');
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