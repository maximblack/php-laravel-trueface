@if ($paginator->getLastPage() > 1)
<ul class="pagination">
    @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
    <a href="{{ $paginator->getUrl($i) }}">
        {{ $i }}
    </a>
    @endfor
    <a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}"
       class="next">
        Next</i>
    </a>
</ul>
@endif