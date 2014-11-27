<blockquote>
    @if(Config::get('language') == 'ro')
        {{$quote->quote_ro}}
    @else
        {{$quote->quote_ru}}
    @endif
</blockquote>
<div class="text-right">{{$quote->author}}</div>