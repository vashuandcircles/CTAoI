@include('partials.header')
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <br> <br><br><br>
                    <h2 class="mb-3">Our Popular Coachings</h2>
                    <p>
                        Replenish man have thing gathering lights yielding shall you
                    </p>
                </div>
            </div>
        </div>
        <div class="row" id="coaching-data">
            @include('data')
        </div>
    </div>
    <div class="ajax-load text-center" style="display: none">
        <p><img src="{{asset('img/loading.gif')}}"/> Loading .....</p>
    </div>
</section>
<script>

    function loadMoreData(page) {
        $.ajax({
            url: '?page=' + page,
            type: 'get',
            datatype: "html",
            beforeSend: function () {
                $(".ajax-load").show();
            }
        }).done(function (data) {
            if (data.html === "") {
                $('.ajax-load').html("That's All Folks!!");
                return;
            }
            $('.ajax-load').hide();
            $('#coaching-data').append(data.html);
        })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
    }

    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page);
        }
    });

</script>

@include('partials.footer')
