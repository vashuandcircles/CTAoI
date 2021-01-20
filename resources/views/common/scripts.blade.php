<script src="{{asset('js/toaster.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.copyUrl').on('click', function () {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(this).data('url')).select();
            document.execCommand("copy");
            $temp.remove();
            jQuery.toaster({message: 'Copied to clipboard', priority: 'success'});
        });

    });

</script>
