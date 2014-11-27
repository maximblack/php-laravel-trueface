@extends('layout')

@section('content')
    <div class="row">
        <div class="columns large-3 multiple-columns admin-menu">
            <div class="row">
                <div class="column small-12 content-block text-center">
                    <a href="{{URL::to('admin/users')}}">
                            <i class="fa fa-users pull-left"></i>
                            Пользователи
                            <span class="label old">{{Widget::users_count()}}</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="column small-12 content-block text-center">
                    <a href="{{URL::to('admin/forms')}}">
                        <i class="fa fa-tasks pull-left"></i>
                        Формы
                        @if(Widget::admin_forms_unconfirmed_count('new_count'))
                            <span class="label">{{Widget::admin_forms_unconfirmed_count('new_count')}}</span>
                        @else
                            <span class="label old">{{Widget::admin_forms_unconfirmed_count('total_count')}}</span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="column small-12 content-block text-center">
                    <a href="{{URL::to('admin/responses')}}">
                        <i class="fa fa-upload pull-left"></i>
                        Компромат
                        @if(Widget::admin_responses_unconfirmed_count('new_count'))
                            <span class="label">{{Widget::admin_responses_unconfirmed_count('new_count')}}</span>
                        @else
                            <span class="label old">{{Widget::admin_responses_unconfirmed_count('total_count')}}</span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="column small-12 content-block text-center">
                    <a href="{{URL::to('admin/quotes')}}">
                        <i class="fa fa-comment-o pull-left"></i>
                        Цитаты
                        <span class="label old">{{Widget::admin_quotes_count()}}</span>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="column small-12 content-block text-center">
                    <a href="{{URL::to('admin/translations')}}">
                        <i class="fa fa-bullhorn pull-left"></i>
                        Переводы
                    </a>
                </div>
            </div>
        </div>
        <div class="columns large-9 multiple-columns last-column">
            {{$content}}
        </div>
</div>
@stop