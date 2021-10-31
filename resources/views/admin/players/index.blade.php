@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Список игроков
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('players.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="PlayersTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Никнейм</th>
                            <th>Фото</th>
                            <th>Описание</th>
                            <th>Состав</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                <td>{{$player->id}}</td>
                                <td>{{$player->name}}</td>
                                <td>{{$player->nickname}}</td>
                                <td>
                                    <img src="{{$player->getImage()}}" alt="" width="100">
                                </td>
                                <td>{{substr($player->player_description, 0, 20) . '...'}}</td>
                                <td>{{$player->getCategoryTitle()}}</td>
                                <td>
                                    <a href="{{route('players.edit', $player->id)}}" class="fa fa-pencil"></a>
                                    @csrf
                                    <button type="button" onclick="deletePlayer({{$player->id}}, '{{csrf_token()}}')"
                                            id="deletePost" class="delete">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


