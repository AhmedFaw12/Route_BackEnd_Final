@extends("master")
@section('contents')

<div class="d-flex justify-content-between mt-2">
    <h2>Departments</h2>
    <a class="btn btn-primary m-1" href="{{route('department.create')}}">Add Department</a>

</div>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Manager</th>
                <th scope="col">Main Department</th>
                <th scope="col">Created_At</th>
                <th scope="col">Updated_At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($depts as $dept)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$dept->name}}</td>
                <td>{{$dept->manager_id}}</td>
                <td>{{$dept->department_id}}</td>
                <td>{{$dept->created_at}}</td>
                <td>{{$dept->updated_at}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Empty Result</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
