@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить игрока
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open([
            'route'	=>	['players.update', $player->id],
            'files'	=>	true,
            'method'	=>	'put'
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем игрока</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Имя игрока</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                   value="{{$player->name}}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Никнейм игрока</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                   value="{{$player->nickname}}" name="nickname">
                        </div>
                        <div class="form-group">
                            <img src="{{$player->getImage()}}" alt="" class="img-responsive" width="200">
                            <label for="exampleInputFile">Лицевое изображение</label>
                            <input type="file" id="exampleInputFile" name="image">
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            {{Form::select('category_id',
                                $categories,
                              $player->getCategoryID(),
                                ['class' => 'form-control select2'])
                            }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание игрока</label>
                            <textarea name="player_description" id="" cols="30" rows="10"
                                      class="form-control">{{$player->player_description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button class="btn btn-warning pull-right">Сохранить</button>
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
