@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Exams</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Exams</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            @include("admin.inc.messages")

                            <div class="card-header">
                                <h3 class="card-title">All Exams</h3>

                                <div class="card-tools">

                                    <a href="{{url('dashboard/exams/create')}}" class="btn btn-sm btn-primary" >Add New Exam</a>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name (en)</th>
                                            <th>Name (ar)</th>
                                            <th>Img</th>
                                            <th>Skill</th>
                                            <th>Questions no.</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$exam->name('en')}}</td>
                                                <td>{{$exam->name('ar')}}</td>
                                                <td>
                                                    <img height="50px" src="{{asset("uploads/$exam->img")}}" alt="exam img">
                                                </td>
                                                <td>{{$exam->skill->name('en')}}</td>
                                                <td>{{$exam->questions_no}}</td>
                                                @if ($exam->active)
                                                    <td><span class="badge bg-success">yes</span></td>
                                                @else
                                                    <td><span class="badge  bg-danger">no</span></td>
                                                @endif
                                                <td>
                                                    <a href="{{url("dashboard/exams/show/{$exam->id}")}}"  class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>

                                                    <a href="{{url("dashboard/exams/show-questions/{$exam->id}")}}"  class="btn btn-sm btn-success"><i class="fas fa-question"></i></a>

                                                    <a href="{{url("dashboard/exams/edit/{$exam->id}")}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>

                                                    <form method ="POST" action="{{url("dashboard/exams/delete/{$exam->id}")}}" style="display:none"  id="delete-form" >
                                                        @csrf
                                                        @method('delete')
                                                    </form>

                                                    <button type="submit" form="delete-form" class="btn btn-sm btn-danger" form="delete-form"><i class="fas fa-trash"></i></button>

                                                    <a href="{{url("dashboard/exams/toggle/{$exam->id}")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>
                                                </td>
                                            </tr>


                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex my-3 justify-content-center">
                                    {{$exams->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script>

    </script>
@endsection

