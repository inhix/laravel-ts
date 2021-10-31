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
                        {{Form::open([
    'route'	=>	['profile.update', $user->id],
    'method'	=>	'put',
    'files'	=>	true
])}}
                    <!-- Default box -->
                        <div class="box">
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Имя</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                                               placeholder=""
                                               value="{{$user->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">E-mail</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                                               placeholder=""
                                               value="{{$user->email}}">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{$user->getImage()}}" alt="" width="200" class="img-responsive">
                                        <label for="exampleInputFile">Аватар</label>
                                        <input type="file" name="avatar" id="exampleInputFile">

                                        <p class="help-block">Какое-нибудь уведомление о форматах..</p>
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
