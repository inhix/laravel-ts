@extends('layout')

@section('content')
    <!--main content start-->
    <div class="main-content" style="margin-top: 100px">
        <div class="container">
            <div class="row py-3">
                <div class="col-md-8">

                    <div class="leave-comment mr0"><!--leave comment-->
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                        @endif
                        <h3 class="text-uppercase">Мой профиль</h3>
                        @include('admin.errors')
                        <br>
                        <strong>Аватарка:</strong>
                        <br>
                        <br>
                        <img src="{{$user->getImage()}}" alt="" style="
              max-width: 100px;
              height: 100px;
              object-fit: cover;
              border-radius: 0%">
                        <br><br>
                        <strong>Никнейм:</strong> {{$user->name}}
                        <br><br>
                        <strong>Почта:</strong> {{$user->email}}
                        <br><br>
                        <strong>Статус аккаунта:</strong>
                        @if($user->email_verified_at===NULL)
                            не подтверждён <br><br>
                            {{Form::open([
                                'route'	=>	['verification.resend'],
                                'method'	=>	'post'
                            ])}}
                        <!-- Default box -->
                            <div class="box">
                                <div class="box-header with-border">
                                    @include('admin.errors')
                                </div>
                                <div class="box-footer">
                                    <button class="btn btn-warning pull-right"
                                            style="background-color:#4638C7; color: white">Отправить ещё раз
                                    </button>
                                </div>
                                <!-- /.box-footer-->
                            </div>
                            <!-- /.box -->
                            {{Form::close()}}
                        @else
                            подтверждён
                        @endif
                    </div><!--end leave comment-->
                </div>
                @include('pages._sidebar')

            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
