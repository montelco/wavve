new Vue({
      el: '#passEditor',
      data: {
        passTitle : '',
        passPrimary : '',
        passBarcode : '',
      },
      methods: {
        createPass: function (e){
            e.preventDefault();
            $.ajax({
                url: '/passes/post',
                type: 'post',
                dataType: 'json',
                data: {
                    "_token": this._token,
                    'title' : this.passTitle,
                    'primary_field' : this.passPrimary,
                    'barcode_value' : this.passBarcode,
                    'template' : 1,
                }
            }).success(function() {
                $('#result').html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> Updated ' + this.passTitle + ' in your pass collection.');
                $('#result').addClass('alert alert-success');
                this.passBarcode = '';
                this.passPrimary = '';
                this.passTitle = '';
            }.bind(this));
        }
      }
    })