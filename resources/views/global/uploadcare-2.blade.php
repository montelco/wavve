<script>
    UPLOADCARE_LOCALE = "en";
    UPLOADCARE_LIVE = "true";
    UPLOADCARE_PUBLIC_KEY = "351ed2274c2d55ccfe18";
    UPLOADCARE_TABS = 'file url facebook instagram gdrive gphotos skydrive dropbox';
</script>
<script src="https://ucarecdn.com/widget/2.10.2/uploadcare/uploadcare.full.min.js" charset="utf-8"></script>
<script>
    var widget = uploadcare.Widget('[role=uploadcare-uploader]');
    widget.onUploadComplete(function(info) {
        $.uploadedURL = info.cdnUrl;
        console.log(info.cdnUrl);
        $('#strip-bg-image').append( '<style>#strip-bg-image{background: url(' + $.uploadedURL + '-/scale_crop/1080x1920/center/-/blur/45/-/quality/lightest/-/progressive/yes/) center center no-repeat; background-size:100% !important;}</style>');
    });
    new Vue({
      el: '#passEditor',
      data: {
        oneTimeRedemption: false,
        passTitle : '',
        passPrimary : '',
        passBarcode : '',
        passExpiry : '',
        passSecondary : '',
        passCashierHelper : '',
        passStripBG: '',
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
                    'design_number' : '2',
                    'primary_field' : this.passPrimary,
                    'secondary_field' : this.passSecondary,
                    'expiry': this.passExpiry,
                    'barcode_value' : this.passBarcode,
                    'cashier_helper' : this.passCashierHelper,
                    'one_time_redemption': this.oneTimeRedemption ? 1 : 0,
                    'strip_background_image': $.uploadedURL
                }
            }).success(function() {
                $('#result').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Updated ' + this.passTitle + ' in your pass collection.');
                $('#result').addClass('alert alert-success');
                this.passBarcode = '';
                this.passPrimary = '';
                this.passTitle = '';
                this.passExpiry,
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