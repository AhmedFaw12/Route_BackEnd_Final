@extends('admin.layout')


@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Question</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/dashboard/exams')}}">Exams</a></li>
                <li class="breadcrumb-item"><a href="{{url("/dashboard/exams/show/{$exam->id}")}}">{{$exam->name('en')}}</a></li>
                <li class="breadcrumb-item active">Edit Question</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 pb-3">

                    @include("admin.inc.errors")

                    <form  method="POST" action="{{url("dashboard/exams/update-question/{$exam->id}/{$question->id}")}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label >Title</label>
                                        <input type="text" name="title" value="{{$question->title}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label >Right Ans.</label>
                                        <input type="number" min="1" max="4" name="right_ans" value="{{$question->right_ans}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label >Option 1</label>
                                        <input type="text" name="option_1" value="{{$question->option_1}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label >Option 2</label>
                                        <input type="text" name="option_2" value="{{$question->option_2}}" class="form-control ">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label >Option 3</label>
                                        <input type="text" name="option_3" value="{{$question->option_3}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label >Option 4</label>
                                        <input type="text" name="option_4" value="{{$question->option_4}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">Submit</button>

                                <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

