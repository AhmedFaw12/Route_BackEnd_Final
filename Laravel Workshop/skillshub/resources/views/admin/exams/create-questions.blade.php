@extends('admin.layout')


@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Add new Exam(Step 2)</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/dashboard/exams')}}">Exams</a></li>
                <li class="breadcrumb-item active">Add new Exam(Step 2)</li>
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

                    <form  method="POST" action="{{url("dashboard/exams/store-questions/{$exam_id}")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @for($i = 1; $i<= $questions_no; $i++)

                                <h5>Question {{$i}} </h5>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label >Title</label>
                                            <input type="text" name="titles[]" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label >Right Ans.</label>
                                            <input type="number" min="1" max="4" name="right_anss[]" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label >Option 1</label>
                                            <input type="text" name="option_1s[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label >Option 2</label>
                                            <input type="text" name="option_2s[]" class="form-control ">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label >Option 3</label>
                                            <input type="text" name="option_3s[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label >Option 4</label>
                                            <input type="text" name="option_4s[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Submit</button>

                            <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
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


@section('scripts')

@endsection
