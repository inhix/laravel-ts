@extends('layout')

@section('content')
    <!-- ======= Matches Section ======= -->
    <section id="matches" class="pricing section-bg" style="padding-top: 100px">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                @if($match->score === NULL)
                    <center><h2>Предстоящий матч</h2></center>
                @else
                    <center><h2>Прошедший матч</h2></center>
                @endif
            </div>

            <p>
            <div>
                <table id="PreviousMatchesTable" class="table table-bordered table-striped" type="">
                    <tbody>

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
                        @if($match->score === NULL)
                            <td><h5>—</h5></td>
                        @else
                            <td><h5>{{$match->score}}</h5></td>
                        @endif
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
                    </tbody>
                </table>
            </div>
        </div>
    </section><!-- End Matches Section -->
@endsection
