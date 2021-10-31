@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Список пользователей
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
                        <a href="{{route('users.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="UsersTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>E-mail</th>
                            <th>Аватар</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <img src="{{$user->getImage()}}" alt="" class="img-responsive" width="80">
                                </td>
                                <td><a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil"></a>
                                    @csrf
                                    {{--	                  {{Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete'])}}--}}
                                    {{--	                  <button onclick="return confirm('are you sure?')" type="submit" class="delete">--}}
                                    {{--	                   <i class="fa fa-remove"></i>--}}
                                    {{--	                  </button>--}}

                                    {{--	                   {{Form::close()}}--}}
                                    <button type="button" onclick="deleteUser({{$user->id}}, '{{csrf_token()}}')"
                                            id="deleteUser" class="delete">
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
