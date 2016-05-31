<link rel="stylesheet" type="text/css" href="{{ url('/meditor/src/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('/meditor/src/js/jquery.notebook.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ url('/meditor/src/js/jquery.notebook.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $( ".editor" ).notebook({
            autoFocus: true,
            placeholder: "It's time to make your mark"
        });
    });
</script>