<div class="row">
    <div class="column small-12 content-block">
        <h3>Завершение регистрации</h3>
        @if($success)
            <div class="row">
                <div class="columns large-7 text-right">
                    <form action="{{URL::to('user/confirm/' . $confirmationCode)}}" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="text" class="large-6" name="email" value="{{$email}}" disabled>
                        <input type="text" class="large-6" name="name" placeholder="ваше имя">
                        <input type="text" class="large-6" name="phone" placeholder="ваш контактный телефон">
                        <input type="password" class="large-6" name="password" placeholder="укажите пароль">
                        <input type="submit" class="button" value="Завершить регистрацию">
                    </form>
                </div>
                <div class="columns large-5">
                    <p>Ваши данные остаются в сохранности</p>
                    <p>Ваше имя будет использоваться в письмах</p>
                    <p>Контактный телефон нужен для смс рассылок</p>
                </div>
            </div>
        @else
            <p>Время данное вам на потверждения регистрации истекло. Повторите регистрацию.</p>
        @endif
    </div>
</div>