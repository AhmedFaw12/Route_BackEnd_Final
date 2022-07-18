@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Exam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/dashboard/exams')}}">Exams</a></li>
                <li class="breadcrumb-item active">Add new Exam</li>
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

                    <form  method="POST" action="{{url('dashboard/exams/store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label >Name (en)</label>
                                    <input type="text" name="name_en" class="form-control" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label >Name (ar)</label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label >Description (en)</label>
                                    <textarea rows="5" name="desc_en" class="form-control textarea"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label >Description (ar)</label>
                                    <textarea rows="5" name="desc_ar" class="form-control textarea" ></textarea>
                                </div>
                            </div>

                            <div class="col-6">
                                {{-- select options/dropdown menu of skills --}}
                                <div class="form-group">
                                    <label>Skill</label>
                                    <select  class=" form-control select" name="skill_id">
                                        @foreach ($skills as $skill)
                                            <option value="{{$skill->id}}">{{$skill->name('en')}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                {{-- upload file --}}
                                <div class="form-group">
                                    <label >Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="img">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-4">
                                <div class="form-group">
                                    <label >Questions no.</label>
                                    <input type="number" name="questions_no" class="form-control" >
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label >Difficulty</label>
                                    <input type="number" name="difficulty" class="form-control" >
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label >Duration (mins.)</label>
                                    <input type="number" name="duration_mins" class="form-control" >
                                </div>
                            </div>
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
