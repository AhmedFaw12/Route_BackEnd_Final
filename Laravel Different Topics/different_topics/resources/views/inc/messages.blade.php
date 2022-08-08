@if(request()->session()->get("success_msg"))
    <div class="alert alert-success">
        <p>{{request()->session()->get("success_msg")}}</p>
    </div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif
