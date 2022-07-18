@if ($paginator->hasPages())

<!-- pagination -->
<div class="col-md-12">
    <div class="post-pagination">
        {{-- previous link --}}
        @if($paginator->onFirstPage())
            <a href="#" class=" btn disabled pagination-back pull-left">{{__('web.back')}}</a>
        @else
            <a href="{{$paginator->previousPageUrl()}}" class="pagination-back pull-left">{{__('web.back')}}</a>
        @endif

        <ul class="pages">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">{{$page}}</li>
                        @else
                            <li><a href="{{$url}}">{{$page}}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- next link --}}
        @if ($paginator->hasMorePages())
            <a href="{{$paginator->nextPageUrl()}}" class="pagination-next pull-right">{{__('web.next')}}</a>
        @else
            <a href="#" class="btn disabled pagination-next pull-right">{{__('web.next')}}</a>
        @endif
    </div>
</div>
<!-- pagination -->

@endif



