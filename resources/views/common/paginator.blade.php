@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" style="float:left;border-left:1px solid 	#1E90FF;border-top:1px solid 	#1E90FF;border-bottom:1px solid 	#1E90FF;width:60px;height:30px;background:#fff;text-align:center;line-height:30px;text-decoration:none;"><span>上一页</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" style="float:left;border-left:1px solid 	#1E90FF;border-top:1px solid 	#1E90FF;border-bottom:1px solid #1E90FF;width:60px;height:30px;background:#fff;text-align:center;line-height:30px;text-decoration:none;" rel="prev">上一页</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" style="float:left;border-left:1px solid 	#1E90FF;border-top:1px solid 	#1E90FF;border-bottom:1px solid 	#1E90FF;width:30px;height:30px;padding-left:10px;"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" style="float:left;border-left:1px solid 	#1E90FF;border-top:1px solid 	#1E90FF;border-bottom:1px solid 	#1E90FF;width:30px;height:30px;text-align:center;line-height:30px;background:#fff;cursor:pointer;"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" style="float:left;border-left:1px solid 	#1E90FF;border-top:1px solid 	#1E90FF;border-bottom:1px solid 	#1E90FF;width:30px;height:30px;text-align:center;line-height:30px;background:#fff;cursor:pointer;">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"  style="float:left;border:1px solid 	#1E90FF;width:60px;height:30px;background:#fff;cursor:pointer;text-align:center;line-height:30px;text-decoration:none;">下一页</a></li>
        @else
            <li class="disabled" style="float:left;border:1px solid 	#1E90FF;width:60px;height:30px;background:#fff;cursor:pointer;text-align:center;line-height:30px;text-decoration:none;"><span>下一页</span></li>
        @endif
    </ul>
    @endif