<div id="header" class="row">
    <div id="header-column" class="column small-12">
        <div id="header-row" class="row">
            <div id="logo-container" class="columns large-2 small-12">
                <a href="{{URL::to('/')}}">
                    <img src="{{URL::asset('img/logo.png')}}">
                </a>
            </div>
            <div class="columns large-4 small-12">
                <ul id="top-menu" class="large-block-grid-3 small-block-grid-1">
                    <li>
                        <a href="{{URL::to('forms')}}" class="text-center">
                            Все формы
                        </a>
                    </li>
                    <li>
                        <a href="{{URL::to('form/add')}}" class="text-center">
                            Добавить
                        </a>
                    </li>
                </ul>
            </div>
            <div id="search-container" class="columns large-3">
                <input id="search" type="text" placeholder="Найти анкету">
            </div>
            <div id="social-container" class="columns large-2">
                <ul class="large-block-grid-3">
                    <li>
                        <a id="social-facebook" href="#">&nbsp;</a>
                    </li>
                    <li>
                        <a id="social-twitter" href="#">&nbsp;</a>
                    </li>
                    <li>
                        <a id="social-googleplus" href="#">&nbsp;</a>
                    </li>
                </ul>
            </div>
            <div class="columns large-1 text-center">
                <a href="#" data-dropdown="user-dropdown" class="user-icon" style="width: 100%">&nbsp;</a>
                <ul id="user-dropdown" class="f-dropdown" data-dropdown-content>
                    <li><a href="{{URL::to('user/logout')}}">Выйти</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


    <div id="user-menu" class="row">
        <div class="column small-12">
            <div class="row">
                @if(Auth::check())
                <div class="columns large-9 soft-devider">
                    <ul class="small-block-grid-{{Auth::user()->admin ? '4' : '3'}} menu" style="white-space: nowrap">
                        @if(Auth::user()->admin)
                        <li>
                            <a href="{{URL::to('admin')}}">
                                <i class="fa fa-dashboard menu-icon"></i>
                                {{Lang::get('messages.admin-panel')}}
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{URL::to('/')}}">
                                <i class="fa fa-edit menu-icon"></i>
                                Моя страница
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('forms/my')}}">
                                <i class="fa fa-thumb-tack menu-icon"></i>
                                Мои анкеты
                                @if(Widget::count_my_forms('new_count'))
                                    <span class="label">{{Widget::count_my_forms('new_count')}}</span>
                                @else
                                    <span class="label old">{{Widget::count_my_forms('total_count')}}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('responses/to-me')}}">
                                <i class="fa fa-upload menu-icon"></i>
                                Мои запросы
                                @if(Widget::count_my_responses('new_count'))
                                    <span class="label">{{Widget::count_my_responses('new_count')}}</span>
                                @else
                                    <span class="label old">{{Widget::count_my_responses('total_count')}}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="columns large-3 text-center">
                    <a id="credits" href="{{URL::to('user/coins')}}">
                        Кредиты: <span class="label">{{Auth::user()->credits}}</span>
                        <i class="fa fa-cog control middle left-delimiter"></i>
                    </a>
                </div>
                @else
                    <div class="columns small-12 text-right">
                        <form action="{{URL::to('user/login')}}" method="post">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <ul class="inline-list pull-right">
                                <li>
                                    <a href="{{URL::to('user/register')}}">Регистрация</a>
                                </li>
                               <li>
                                   <input type="text" name="email" placeholder="Email">
                               </li>
                               <li>
                                   <input type="password" name="password" placeholder="Пароль">
                               </li>
                               <li>
                                   <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/>
                                   <a onclick="$(this).closest('form').submit();" type="submit" class="user-icon" href="javascript:void(0);">&nbsp;</a>
                               </li>
                            </ul>
                        </form>
                    </div>
                @endif
            </div>


        </div>
    </div>


<div id="navigation-menu" class="row">
    <div class="columns large-2 country-container">

        <a id="dropdown-country-link" href="#" data-dropdown="dropdown-country">
            <img src="{{URL::asset('img/md.png')}}">
            <span>Молдавия</span>
        </a>

        <ul id="dropdown-country" data-dropdown-content class="f-dropdown">
            <li><a href="#">Romania</a></li>
            <li><a href="#">Россия</a></li>
        </ul>
    </div>
    <div class="columns large-2 soft-devider">
        @if(Config::get('language') == 'ru')
            <a href="{{URL::to('language/change/ro')}}">{{Lang::get('messages.language-ro')}}</a>
        @else
            <a href="{{URL::to('language/change/ru')}}">{{Lang::get('messages.language-ru')}}</a>
        @endif
    </div>
    <div class="column large-8">
        <ul class="large-block-grid-3">
            <li>
                <a href="#">
                    Как работает <span>trueface</span>?
                </a>
            </li>
            <li>
                <a href="#">
                    Условия использования
                </a>
            </li>
            <li>
                <a href="#">
                    Конфиденциальность
                </a>
            </li>
        </ul>
    </div>
</div>