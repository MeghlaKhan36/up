<ul class="pagination-wrap">
    @if ( $pagination->currentPage() === 1)
    <li class="disabled">
    @else
    <li>
    @endif
        <a href="{{ $pagination->url($pagination->currentPage() - 1) }}">previous</a>
    </li>
    @for ($i = 1; $i <= $pagination->lastPage(); $i++)
        @if ( $pagination->currentPage() === $i )
        <li class="active">
        @else
        <li>
        @endif
            <a href="{{ $pagination->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    @if ( $pagination->currentPage() === $pagination->lastPage())
    <li class="disabled">
    @else
    <li>
    @endif
        <a href="{{ $pagination->url($pagination->currentPage() + 1) }}">next</a>
    </li>
</ul>