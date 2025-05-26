<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };
    @if ($message = Session::get('primary'))
        toastr.info("{{$message}}");
    @endif
    @if ($message = Session::get('success'))
        toastr.success("{{$message}}");
    @endif
    @if ($message = Session::get('error'))
        toastr.error("{{$message}}");
    @endif
    @if ($message = Session::get('warrning'))
        toastr.warning("{{$message}}");
    @endif
</script>