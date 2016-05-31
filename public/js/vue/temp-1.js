var widget = uploadcare.Widget('[role=uploadcare-uploader]');
widget.onUploadComplete(function(info) {
    var uploadedURL =  'https://ucarecdn.com/' + info.uuid + '/';
    $('#passPreviewer').append( '<style>#passPreviewer{background: url(' + uploadedURL + '-/scale_crop/1080x1920/center/-/blur/45/-/quality/lightest/-/progressive/yes/) center center no-repeat; background-size:100% !important;}</style>');
    var demo = new Vue({
      el: '#passEditor',
      data: {
        passTitle : '',
        passPrimary : '',
        passBarcode : '',
        passFullBG: '',
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
                    'coupon_full_background_image': uploadedURL,
                    'template' : 1,
                }
            }).success(function() {
                uploadcare.Widget('#file-uploader').value(null);
                $('#passPreviewer').css('background', '#f7f7f7');
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
});