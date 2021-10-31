@extends('layout')
@section('content')
    <!-- ======= News Section ======= -->
    <section id="news" class="portfolio" style="padding-top: 100px">
        <div class="container" data-aos="fade-up">

        @if(!empty($post->image))

            <!-- ======= Portfolio Details Section ======= -->
                <section id="portfolio-details" class="portfolio-details">
                    <div class="container">

                        <div class="row gy-4">

                            <div class="col-lg-8">
                                <div class="portfolio-details-slider swiper-container">
                                    <div class="">
                                        <h2>{{$post->title}}</h2><br>
                                        <a style="float: left">Автор:
                                            <strong>{{ App\User::where('id', "$post->user_id")->first()->name }}</strong></a>
                                        <a style="float: right">Дата публикации: <strong>{{ $post->date }}</strong></a>
                                        <br><br>

                                        <div class="">
                                            <img src="{{ $post->getImage() }}" alt="">
                                        </div>
                                        <div class="">

                                            <p>
                                                {!! $post->content !!}
                                            </p>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                            @foreach($latestNews as $news)
                                <!-- ======= Portfolio Details Section ======= -->
                                    <section id="portfolio-details" class="portfolio-details">
                                        <div class="">

                                            <div class="row gy-4">

                                                <div class="col-lg-6">
                                                    <div class="portfolio-details-slider swiper-container">
                                                        <div class="swiper-wrapper align-items-center">

                                                            <div class="">
                                                                <img src="{{ $news->getImage() }}" alt="">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="portfolio-description2" style="font-size: 4px">
                                                        <a href="{{ route('news.show', "$news->id") }}">
                                                            <h2>{{$news->title}}</h2></a>
                                                        <br>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </section><!-- End Portfolio Details Section -->
                                @endforeach
                            </div>

                        </div>

                    </div>
                </section><!-- End Portfolio Details Section -->
            @endif
        </div>
    </section><!-- End News Section -->
@endsection
