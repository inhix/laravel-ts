@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Список категорий
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
                        <a href="{{route('categories.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="CategoriesTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Иконка</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->title}}</td>
                                <td>
                                    <img src="{{$category->getIcon()}}" alt="" width="100">
                                </td>
                                <td><a href="{{route('categories.edit', $category->id)}}" class="fa fa-pencil"></a>

                                    {{--	                  {{Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'delete'])}}--}}
                                    {{--	                  <button onclick="return confirm('are you sure?')" type="submit" class="delete">--}}
                                    {{--	                   <i class="fa fa-remove"></i>--}}
                                    {{--	                  </button>--}}

                                    {{--	                   {{Form::close()}}--}}
                                    <button type="button"
                                            onclick="deleteCategory({{$category->id}}, '{{csrf_token()}}')"
                                            id="deleteCategory" class="delete">
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
