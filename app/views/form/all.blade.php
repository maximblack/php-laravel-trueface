@extends('layout_2_columns')

@section('content-2')
<div class="row">
    <div class="columns large-8 multiple-columns">
        @if(count($forms) > 0)
            @foreach($forms as $form)
                <div class="row">
                    <div class="column small-12 content-block form">
                        <div class="row">
                            <div class="column large-6">
                                <div class="row">
                                    <div class="column small-12 text-center">
                                        <a href="{{URL::to('form/view/')}}/{{$form->id}}">
                                            @if(isset($form->files[0]))
                                                <img class="th" src="{{URL::asset('files')}}/{{$form->files[0]->name}}">
                                            @else
                                                <span class="image-none th">
                                                    Фотография отсутствует
                                                </span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="column small-12">
                                        <p>{{{$form->description ? str_limit($form->description, 80) : "Описание отсутствует"}}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="column large-6 main">
                                <label>Имя</label>
                                <h5>{{{$form->name ? $form->name : "Не указанно"}}}</h5>
                                <label>Имя</label>
                                <h5> {{{$form->surname ? $form->surname : "Не указанно"}}}</h5>
                                <p>
                                    <a href="#">Подробнее</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="column small-12 content-block">
                    <p>
                        Нет форм
                    </p>
                </div>
            </div>
        @endif
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
                                <a {{$filter == 'date' ? 'class="active"' : ''}} href="{{URL::to('responses/my/date')}}">Дате</a>
                                <p>Сортировать по дате добавления</p>
                            </li>
                            <li>
                                <a {{$filter == 'form_name' ? 'class="active"' : ''}} href="{{URL::to('responses/my/form_name')}}">Имя формы</a>
                                <p>Сортировать по имени формы</p>
                            </li>
                            <li>
                                <a {{$filter == 'paid' ? 'class="active"' : ''}} href="{{URL::to('responses/my/paid')}}">Оплаченно</a>
                                <p>Показывать только оплаченный</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop