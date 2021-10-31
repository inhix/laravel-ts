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
                        <h3 class="text-uppercase">Изменение пароля</h3>
                        @include('admin.errors')
                        <br>
                        {{Form::open([
                            'route'	=>	['password.update', $user->id],
                            'method'	=>	'post'
                        ])}}
                    <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                @include('admin.errors')
                            </div>
                            <div class="box-body">
                                <div class="col-md-6">
                                    <input type="hidden" name="token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                    <div class="form-group">
                                        <label for="password">Пароль</label>
                                        <input type="password" class="form-control" id="exampleInputEmail1"
                                               name="password"
                                               placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Подтвердите пароль</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button class="btn btn-warning pull-right">Изменить</button>
                            </div>
                            <!-- /.box-footer-->
                        </div>
                        <!-- /.box -->
                        {{Form::close()}}
                    </div><!--end leave comment-->
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection
