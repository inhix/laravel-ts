@extends('layout')

@section('content')
    <!-- ======= Matches Section ======= -->
    <section id="matches" class="pricing section-bg" style="padding-top: 100px">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Матчи</h2>
            </div>
            <center><h5>Предстоящие матчи</h5></center>
            @if(count($upcomingMatches) > 0)
                <div>

                    <table id="UpcomingMatchesTable" class="table table-bordered table-striped" type="">
                        <tbody>

                        @foreach($upcomingMatches as $match)
                            <tr>
                                <td>
                                    <img src="/storage/images/{{$match->getCategoryIcon()}}" alt="" width="70">
                                    <p>
                                </td>
                                <td>
                                    <img src="/storage/images/TSLogo.png" alt="" height="50">
                                    <p>
                                        Team Spirit
                                </td>
                                <td>
                                    <a href="{{ route('match.show',"$match->id") }}"><h5>—</h5></a>
                                </td>
                                <td>
                                    <img src="{{$match->getOpponentLogo()}}" alt="" height="50">
                                    <p>
                                    {{$match->opponent_name}}
                                </td>
                                <td><h5>{{$match->tournament}}</h5></td>
                                <td>
                                    <h2>{{date("h:i", strtotime($match->start_time))}}</h2>
                                    <p>
                                    {{date("d.m.Y", strtotime($match->start_time))}}</td>
                                <td>
                            <tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            @else
                <p></p>
                <center><h3>Предстоящих матчей нет</h3></center>
            @endif

            <center><h5>Прошедшие матчи</h5></center>
            <p>
            @if(count($previousMatches) > 0)
                <div>

                    <table id="PreviousMatchesTable" class="table table-bordered table-striped" type="">
                        <tbody>

                        @foreach($previousMatches as $match)
                            <tr>
                                <td>
                                    <img src="/storage/images/{{$match->getCategoryIcon()}}" alt="" width="70">
                                    <p>
                                </td>
                                <td>
                                    <img src="/storage/images/TSLogo.png" alt="" height="50">
                                    <p>
                                        Team Spirit
                                </td>

                                <td><a href="{{ route('match.show',"$match->id") }}"><h5>{{$match->score}}</h5></a></td>
                                <td>
                                    <img src="{{$match->getOpponentLogo()}}" alt="" height="50">
                                    <p>
                                    {{$match->opponent_name}}
                                </td>
                                <td><h5>{{$match->tournament}}</h5></td>
                                <td>
                                    <h2>{{date("H:i", strtotime($match->start_time))}}</h2>
                                    <p>
                                    {{date("d.m.Y", strtotime($match->start_time))}}</td>
                                <td>
                            <tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                    {{--                    <td>Дисциплина</td>--}}
                    {{--                    <td>Команда</td>--}}
                    {{--                    <td>Счёт</td>--}}
                    {{--                    <td>Соперник</td>--}}
                    {{--                    <td>Дата</td>--}}
                    {{--                    <td>Турнир</td>--}}
                    {{--                </tr>--}}

                </div>
        </div>
    </section><!-- End Matches Section -->
@endsection
