@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Список матчей
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
                        <a href="{{route('matches.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="MatchesTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Категория</th>
                            <th>Счёт</th>
                            <th>Название соперника</th>
                            <th>Логотип соперника</th>
                            <th>Турнир</th>
                            <th>Начало матча</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($matches as $match)
                            <tr>
                                <td>{{$match->id}}</td>
                                <td>{{$match->getCategoryTitle()}}</td>
                                <td>{{$match->score}}</td>
                                <td>{{$match->opponent_name}}</td>
                                <td>
                                    <img src="{{$match->getOpponentLogo()}}" alt="" width="100">
                                </td>
                                <td>{{$match->tournament}}</td>
                                <td>{{$match->start_time}}</td>
                                <td>
                                    <a href="{{route('matches.edit', $match->id)}}" class="fa fa-pencil"></a>
                                    @csrf
                                    <button type="button" onclick="deleteMatch({{$match->id}}, '{{csrf_token()}}')"
                                            id="deleteMatch" class="delete">
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


