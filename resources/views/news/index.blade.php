@extends('layout')
@section('content')
    <!-- ======= News Section ======= -->
    <section id="news" class="portfolio" style="padding-top: 100px">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Новости</h2>
            </div>

            @foreach($posts as $news)
                @if(!empty($news->image))

                    <section id="portfolio-details" class="portfolio-details">
                        <div class="container">

                            <div class="row gy-4">

                                <div class="col-lg-5">
                                    <div class="portfolio-details-slider swiper-container">
                                        <div class="swiper-wrapper align-items-center">
                                            <a href="{{ route('news.show', "$news->id") }}">
                                                <div class="">
                                                    <img src="{{ $news->getImage() }}" alt="">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <div class="portfolio-description">
                                        <a href="{{ route('news.show', "$news->id") }}"><h2>{{$news->title}}</h2></a>
                                        <p>
                                            {!! $news->description !!}
                                        </p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>
                @endif
            @endforeach

        </div>
    </section>
@endsection
