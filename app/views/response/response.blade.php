@extends('layout_2_columns')

@section('content-2')
    <script src="{{URL::asset('js/CodoPlayer.js')}}"></script>

    <!--
    <div class="row">
        <div class="column small-12 multiple-columns last-column">
            <div class="row">
                <div class="column small-12 content-block">
                    <ul class="breadcrumbs">
                        <li><a href="{{URL::to('/')}}">Моя страница</a></li>
                        <li><a href="#">Мои запросы</a></li>
                        <li><a href="#">Добавить запрос</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    -->

    <div class="row">
        <div class="column large-8 multiple-columns">

            @foreach($responses as $response)
                @if(isset($response))
                    <div class="row">
                        <div class="columns small-12 content-block">
                            <div class="row">
                                <div class="columns small-12 text-right">
                                    @if(!$response->confirmed)
                                        <span class="label">
                                            <i class="fa fa-cog fa-spin pull-left"></i>
                                            Проверяется модератором
                                        </span>
                                    @else
                                        <span class="label success">
                                            Ожидание оплаты
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="divider"></div>

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
                            @if($category == 'my' || $response->paid)
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
                            @else
                                <div id="response-container-{{$response->id}}" class="row panel">
                                    <div class="columns large-8">
                                        @if($response->type == 'image')
                                            <i class="fa fa-picture-o icon"></i>
                                            <span class="response-type">Изображение</span>
                                        @elseif($response->type == 'movie')
                                            Видеоролик
                                        @elseif($response->type == 'audio')
                                            Аудиофайл
                                        @endif
                                        <hr>
                                        <label>Коментарий</label>
                                        <p>
                                            {{$response->description}}
                                        </p>
                                    </div>
                                    <div class="columns large-4">
                                        <div class="row">
                                            <div class="column small-12 text-center">
                                                <label class="money">Цена</label>
                                                <span class="money">
                                                    {{$response->price}}<i class="fa fa-money"></i>
                                                </span>

                                                <div class="divider"></div>

                                                <a class="button tiny pay-reveal" href="{{URL::to('response/pay')}}/{{$response->id}}" data-reveal-id="modal-pay-{{$response->id}}" data-reveal-ajax="true">Оплатить</a>
                                                <div id="modal-pay-{{$response->id}}" class="reveal-modal" data-reveal>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($category == 'my')
                                <div class="divider"></div>

                                <form class="response-update" action="{{URL::to('response/update/')}}/{{$response->id}}" method="post">

                                    <label>Коментарий к запросу
                                        <textarea name="description">{{$response->description}}</textarea>
                                    </label>

                                    <div class="divider"></div>

                                    <label>Цена которую вы просите</label>

                                    <div class="divider"></div>

                                    <input type="hidden" data-from="{{$response->price}}" class="range-slider" id="range-slider-{{$response->id}}" name="price" value="" />

                                <div class="divider"></div>

                                <div class="row">
                                    <div class="columns large-6">

                                    </div>
                                    <div class="columns large-6 text-right">
                                            <input type="submit" value="Сохранить" class="button tiny" href="#">

                                            <a class="button tiny alert" href="#">
                                                Удалить
                                            </a>
                                    </div>
                                </div>
                                @endif

                            </form>

                            <script>
                                $('.response-update').ajaxForm({
                                    error: function() {
                                        alert('error');
                                    }
                                });
                            </script>

                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="columns large-4 multiple-columns last-column">
            <div class="row">
                <div class="column small-12 content-block filters">
                    <div class="row">
                        <div class="columns large-3">
                            <i class="fa fa-briefcase icon"></i>
                        </div>
                        <div class="columns large-9">
                            <ul class="small-block-grid-1">
                                <li>
                                    <a @if($category == 'my') class="active" @endif href="{{URL::to('responses/my')}}">Мой компромат</a>
                                    <p>Показать мои заявки</p>
                                </li>
                                <li>
                                    <a @if($category == 'to-me') class="active" @endif href="{{URL::to('responses/to-me')}}">Мне прислали</a>
                                    <p>Показать ответы на мои формы</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="column small-12 content-block filters">
                    <div class="row">
                        <div class="columns large-3">
                            <i class="fa fa-sort-amount-desc icon"></i>
                        </div>
                        <div class="columns large-9">
                            <ul class="small-block-grid-1">
                                <li>
                                    <a {{isset($filter) && $filter == 'date' ? 'class="active"' : ''}} href="{{URL::to('responses/my/date')}}">Дате</a>
                                    <p>Сортировать по дате добавления</p>
                                </li>
                                <li>
                                    <a {{isset($filter) && $filter == 'form_name' ? 'class="active"' : ''}} href="{{URL::to('responses/my/form_name')}}">Имя формы</a>
                                    <p>Сортировать по имени формы</p>
                                </li>
                                <li>
                                    <a {{isset($filter) && $filter == 'paid' ? 'class="active"' : ''}} href="{{URL::to('responses/my/paid')}}">Оплаченно</a>
                                    <p>Показывать только оплаченный</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

    $(".range-slider").each(function(index, element) {
        $(this).ionRangeSlider({
            min: 10,
            max: 100,
            type: 'single',
            step: 5,
            postfix: " кредита",
            prettify: true,
            hasGrid: true
        });
    });

</script>

@stop