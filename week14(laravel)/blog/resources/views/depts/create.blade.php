@extends("master")
@section('contents')
<div class="d-flex justify-content-between mt-2">
    <h5>Add New Department</h5>
    <a class="btn btn-primary m-1" href="{{route('department.index')}}">List Departments</a>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <form method="POST" action="{{route('department.store')}}">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter Department Name" aria-describedby="helpId">

                  <input type="submit" class="btn btn-sm btn-primary m-1" value="Save">
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
