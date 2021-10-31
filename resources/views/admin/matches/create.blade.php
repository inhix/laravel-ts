@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить матч
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open([
            'route'	=> 'matches.store',
            'files'	=>	true
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавляем матч</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Имя соперника</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                   name="opponent_name" value="{{old('opponent_name')}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Логотип соперника</label>
                            <input type="file" id="exampleInputFile" name="opponent_logo">

                            <p class="help-block">Какое-нибудь уведомление о форматах..</p>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            {{Form::select('category_id',
                                $categories,
                                null,
                                ['class' => 'form-control select2'])
                            }}
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Время начала матча:</label>
                            <div class="input-group date">
                                <input id="timestamp" type="datetime-local" type="text" value="{{old('start_time')}}"
                                       name="start_time">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="exampleInputEmail1">Турнир</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                               value="{{old('tournament')}}" name="tournament">
                    </div>
                    <div class="col-md-12">
                        <label for="exampleInputEmail1">Счёт</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                               value="{{old('score')}}" name="score">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default" href="{{route('matches.index')}}">Назад</button>
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
