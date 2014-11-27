<div class="row">
    <div class="columns small-12 content-block">
        <div onclick="switch_state(this)" response-id="{{$response->id}}" class="label {{$response->confirmed ? "success" : ""}} switch-button"><i class="fa fa-power-off pull-left"></i>
            <span>
                @if($response->confirmed)
                    Модерировано
                @else
                    Не разрешенно
                @endif
            </span>
        </div>

        <label>
            Форма
        </label>
        <div class="row panel">
            <div class="columns large-6">
                <label>Имя</label>
                <h5>{{{$response->form->name ? $response->form->name : "Не указанно"}}}</h5>
            </div>
            <div class="columns large-6">
                <label>Фамилия</label>
                <h5> {{{$response->form->surname ? $response->form->surname : "Не указанно"}}}</h5>
            </div>
        </div>
        <div class="divider"></div>
        <label>
            Контент компромата
        </label>
        @if($response->type == 'image')
        <img class="th" src="{{URL::to('response/get')}}/{{$response->id}}">
        @elseif($response->type == 'movie')
        <script type='text/javascript'>
            CodoPlayer('{{URL::to('response/get')}}/{{$response->id}}')
        </script>
        @elseif($response->type == 'audio')
        <script type='text/javascript'>
            CodoPlayer('{{URL::to('response/get')}}/{{$response->id}}')
        </script>
        @endif
        <div class="divider"></div>
        <label>
            Коментарий
        </label>
        @if($response->description)
            <p>
                {{$response->description}}
            </p>
        @else
            Коментарий отсутствует
        @endif

    </div>
</div>

<a class="close-reveal-modal">&#215;</a>