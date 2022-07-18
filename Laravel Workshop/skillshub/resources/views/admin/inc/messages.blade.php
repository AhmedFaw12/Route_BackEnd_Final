@if(session("msg"))
    @if(session("type"))
        <div class="alert alert-success">
            {{session("msg")}}
        </div>
    @else
        <div class="alert alert-danger">
            {{session("msg")}}
        </div>
    @endif
@endif
