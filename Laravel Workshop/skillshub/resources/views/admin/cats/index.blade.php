@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
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
                                <h3 class="card-title">All Categories</h3>

                                <div class="card-tools">
                                    
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target = "#add-modal">Add New Category</button>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name (en)</th>
                                            <th>Name (ar)</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cats as $cat)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$cat->name('en')}}</td>
                                                <td>{{$cat->name('ar')}}</td>
                                                @if ($cat->active)
                                                    <td><span class="badge bg-success">yes</span></td>
                                                @else
                                                    <td><span class="badge  bg-danger">no</span></td>
                                                @endif

                                                <td>

                                                    <button type="button" class="btn btn-sm btn-info edit-btn" data-toggle="modal" data-id="{{$cat->id}}" data-name-en = "{{$cat->name('en')}}" data-name-ar = "{{$cat->name('ar')}}" data-target = "#edit-modal"><i class="fas fa-edit"></i></button>

                                                    <form id="delete-form" action="{{url("/dashboard/categories/delete/$cat->id")}}" method="POST" style="display:none">
                                                        @csrf
                                                        @method("delete")
                                                    </form>
                                                    <button  type="submit" form="delete-form" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                                                    <a href="{{url("/dashboard/categories/toggle/$cat->id ")}}" class="btn btn-sm btn-secondary"><i class="fas fa-toggle-on"></i></a>
                                                </td>
                                            </tr>


                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex my-3 justify-content-center">
                                    {{$cats->links()}}
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


    <!-- Add new Category Modal -->
    <div class="modal fade" id="add-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    @include("admin.inc.errors")

                    <form id="add-form" method="POST" action="{{url('dashboard/categories/store')}}">
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
                                    <input type="text" name="name_ar" class="form-control" >
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-form" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Add new Category Modal -->


    <!-- Edit Modal -->
    <div class="modal fade" id="edit-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    @include("admin.inc.errors")

                    <form id="edit-form" method="POST" action="{{url('dashboard/categories/update')}}">
                        @csrf
                        @method("put")
                        <input type="hidden" name="id" id="edit-form-id">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label >Name (en)</label>
                                    <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label >Name (ar)</label>
                                    <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Edit Modal -->

@endsection

@section('scripts')
    <script>
        $('.edit-btn').click(function(){
            let id = $(this).attr('data-id');
            let nameEn = $(this).attr('data-name-en');
            let nameAr = $(this).attr('data-name-ar');

            $("#edit-form-id").val(id);
            $("#edit-form-name-en").val(nameEn);
            $("#edit-form-name-ar").val(nameAr);
        });
    </script>
@endsection

