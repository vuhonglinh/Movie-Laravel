@extends('layout.client.main')

@section('title', 'Xem phim')

@section('content')
    <!-- details -->
    <section class="section section--details section--bg" data-bg="img/section/details.jpg">
        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <h1 class="section__title section__title--mb">{{ $movie->name }} {{ $episode->name }}</h1>
                </div>
                <!-- end title -->

                <!-- content -->
                <div class="col-12 col-xl-6">
                    <div class="card card--details">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-5">
                                <div class="card__cover">
                                    <img src="{{ $movie->thumbnail }}" alt="">
                                    <span class="card__rate card__rate--green">{{ $movie->averageRating() }}</span>
                                </div>
                                <a href="{{ $movie->trailer_url }}" class="card__trailer"><i
                                        class="icon ion-ios-play-circle"></i> Xem trailer</a>
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-md-8 col-lg-9 col-xl-7">
                                <div class="card__content">
                                    <ul class="card__meta">
                                        <li><span>Đạo diễn:</span> {{ $movie->directors }}</li>
                                        <li><span>Thể loại:</span>
                                            @foreach ($movie->genres as $genre)
                                                <a href="{{ route('mucluc.genres', $genre) }}">{{ $genre->name }}</a>
                                            @endforeach
                                        </li>
                                        <li><span>Thời gian phát hành:</span> {{ $movie->release_date }}</li>
                                        <li><span>Thời lượng:</span> 130 min</li>
                                        <li><span>Quốc gia:</span>
                                            @foreach ($movie->countries as $country)
                                                <a
                                                    href="{{ route('mucluc.countries', $country) }}">{{ $country->name }}</a>
                                            @endforeach
                                        </li>
                                        @if ($movie->is_series == 1)
                                            <li><span> Phim bộ:</span>
                                                @foreach ($movie->episodes as $episode)
                                                    <a
                                                        href="{{ route('xemphim.episode', ['movie' => $movie, 'episode' => $episode]) }}">{{ $episode->name }}</a>
                                                @endforeach
                                        @endif
                                        </li>
                                    </ul>
                                    <div class="card__description">
                                        {!! $movie->description !!}
                                    </div>

                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->

                <!-- player -->
                <div class="col-12 col-xl-6">
                    <video controls playsinline poster="{{ $movie->thumbnail }}" id="player"
                        src="{{ $movie->movie_url }}">
                        <!-- Video files -->
                        <source src="{{ $episode->movie_url }}" type="video/mp4" size="576">
                        <source src="{{ $episode->movie_url }}" type="video/mp4" size="720">
                        <source src="{{ $episode->movie_url }}" type="video/mp4" size="1080">

                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="{{ $episode->movie_url }}" download>Download</a>
                    </video>
                </div>
                <!-- end player -->
            </div>
        </div>
        <!-- end details content -->
    </section>
    <!-- end details -->

    <!-- content -->
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Tổng quan</h2>
                        <!-- end content title -->

                        <!-- content tabs nav -->
                        <ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab"
                                    aria-controls="tab-1" aria-selected="true">Bình luận</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
                                    aria-selected="false">Đánh giá</a>
                            </li>
                        </ul>
                        <!-- end content tabs nav -->

                        <!-- content mobile tabs nav -->
                        <div class="content__mobile-tabs" id="content__mobile-tabs">
                            <div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <input type="button" value="Comments">
                                <span></span>
                            </div>

                            <div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab"
                                            href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Bình
                                            luận</a></li>

                                    <li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2"
                                            role="tab" aria-controls="tab-2" aria-selected="false">Đánh giá</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end content mobile tabs nav -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-8">
                    <!-- content tabs -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                            <div class="row">
                                <!-- comments -->
                                <div class="col-12">
                                    <div class="comments">
                                        <form action="" class="form">
                                            @csrf
                                            <textarea id="comment_content" name="text" class="form__textarea" placeholder="Thêm bình luận..."></textarea>
                                            <button type="button" id="btn-add-comment" class="form__btn">Gửi</button>
                                        </form>
                                        <ul class="comments__list">
                                            {!! $comments !!}
                                        </ul>
                                    </div>
                                </div>
                                <!-- end comments -->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                            <div class="row">
                                <!-- reviews -->
                                <div class="col-12">
                                    <div class="reviews">
                                        <ul class="reviews__list">
                                            {!! $reviews !!}
                                        </ul>

                                        <form action="#" class="form">
                                            @csrf
                                            <textarea class="form__textarea" id="review_content" placeholder="Nôi dung đánh giá..."></textarea>
                                            <div class="form__slider">
                                                <div class="star-widget">
                                                    <input type="radio" name="star" id="rate-10" value="10">
                                                    <label for="rate-10"></label>
                                                    <input type="radio" name="star" id="rate-9" value="9">
                                                    <label for="rate-9"></label>
                                                    <input type="radio" name="star" id="rate-8" value="8">
                                                    <label for="rate-8"></label>
                                                    <input type="radio" name="star" id="rate-7" value="7">
                                                    <label for="rate-7"></label>
                                                    <input type="radio" name="star" id="rate-6" value="6">
                                                    <label for="rate-6"></label>
                                                    <input type="radio" name="star" id="rate-5" value="5">
                                                    <label for="rate-5"></label>
                                                    <input type="radio" name="star" id="rate-4" value="4">
                                                    <label for="rate-4"></label>
                                                    <input type="radio" name="star" id="rate-3" value="3">
                                                    <label for="rate-3"></label>
                                                    <input type="radio" name="star" id="rate-2" value="2">
                                                    <label for="rate-2"></label>
                                                    <input type="radio" name="star" id="rate-1" value="1">
                                                    <label for="rate-1"></label>
                                                </div>
                                            </div>
                                            <button type="button" onclick="add_reviews(this)"
                                                class="form__btn">Gửi</button>
                                        </form>

                                    </div>
                                </div>
                                <!-- end reviews -->
                            </div>
                        </div>

                    </div>
                    <!-- end content tabs -->
                </div>

                <!-- sidebar -->
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="row row--grid">
                        <!-- section title -->
                        <div class="col-12">
                            <h2 class="section__title section__title--sidebar">Phim được đánh giá cao</h2>
                        </div>
                        <!-- end section title -->

                        <!-- card -->
                        @foreach ($rateMovies as $item)
                            <div class="col-6 col-sm-4 col-lg-6">
                                <div class="card">
                                    <div class="card__cover">
                                        <img src="{{ $item->thumbnail }}" alt="">
                                        <a href="{{ route('xemphim.index', $item) }}" class="card__play">
                                            <i class="icon ion-ios-play"></i>
                                        </a>
                                        <span class="card__rate card__rate--red">{{ $item->averageRating() }}</span>
                                    </div>
                                    <div class="card__content">
                                        <h3 class="card__title"><a
                                                href="{{ route('xemphim.index', $item) }}">{{ $item->name }}</a></h3>
                                        <span class="card__category">
                                            @foreach ($item->genres as $genre)
                                                <a href="{{ route('mucluc.genres', $genre) }}">{{ $genre->name }}</a>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- end card -->

                    </div>
                </div>
                <!-- end sidebar -->
            </div>
        </div>
    </section>
    <!-- end content -->
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var video = document.getElementById('player');
            var viewed = false;
            video.addEventListener('play', function() {
                if (!viewed) {
                    var tokenValue = $('input[name="_token"]').val();
                    var data = {
                        _token: tokenValue
                    }
                    $.ajax({
                        url: "{{ route('xemphim.addView', request()->route()->movie) }}",
                        type: "POST",
                        data: data,
                        typeData: 'html',
                        success: function(data) {
                            console.log(data);
                            viewed = true;
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function add_reviews(_this) {
            var star = $("input[name='star']:checked").val();
            var review_content = $("#review_content").val();
            var tokenValue = $('input[name="_token"]').val();
            if (review_content == undefined || star == undefined) {
                return false;
            }
            var data = {
                _token: tokenValue,
                star: star,
                review_content: review_content,
            }
            $.ajax({
                url: "{{ route('xemphim.reviews', request()->route()->movie) }}",
                method: "POST",
                data: data,
                dataType: "html",
                success: function(data) {
                    $("#review_content").val("");
                    $("input[name='star']:checked").prop('checked', false);
                    $(".reviews__list").html(data);
                }
            })
        }
    </script>
    <script>
        function show_reply(_this) { //Hiển thị táp phản hồi
            $(".show_reply").html("");
            $(".btn_reply").attr('onclick', 'show_reply(this)');
            $(_this).off('click');
            const id = $(_this).val();
            $("#show_reply_" + id).html(`<form action="" class="form">
        <textarea id="comment_reply" name="text" class="form__textarea" placeholder="Bình luận ở đây..."></textarea>
        <button value="` + id + `" onclick="add_reply(this)" type="button" class="form__btn">Gửi</button>
        </form>`)
            $(_this).attr('onclick', 'hidden_reply(this)');
        }

        function hidden_reply(_this) { //Ẩn táp phẩn hồi
            $(_this).off('click');
            $(".show_reply").html("");
            $(_this).attr('onclick', 'show_reply(this)');
        }


        function add_reply(_this) { //Thêm bình luận phản hồi
            var parent_id = $(_this).val();
            var comment_content = $("#comment_reply").val();
            var tokenValue = $('input[name="_token"]').val();
            if (comment_content == undefined) {
                return false;
            }
            var data = {
                _token: tokenValue,
                comment_content: comment_content,
                parent_id: parent_id,
            };
            $.ajax({
                url: "{{ route('xemphim.add', request()->route()->movie) }}",
                method: "POST",
                data: data,
                dataType: 'html',
                success: function(data) {
                    $(".show_reply").html("");
                    $(".comments__list").html(data);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            const btnAddComment = $('#btn-add-comment');
            btnAddComment.click(function() {
                const comment_content = $('#comment_content').val();
                var tokenValue = $('input[name="_token"]').val();
                if (comment_content === "") {
                    return false;
                }
                const data = {
                    _token: tokenValue,
                    comment_content: comment_content
                };
                $.ajax({
                    url: "{{ route('xemphim.add', request()->route()->movie) }}",
                    type: "POST",
                    data: data,
                    typeData: 'html',
                    success: function(data) {
                        console.log(data);
                        $('#comment_content').val("");
                        $('.comments__list').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
