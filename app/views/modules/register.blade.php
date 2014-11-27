<h3>Бесплатная регистрация</h3>
<form action="{{URL::to('user/register')}}" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row collapse">
        <div class="columns large-1">
            <span class="prefix">@</span>
        </div>
        <div class="columns large-8">
            <input type="email" name="email" placeholder="ваш email">
        </div>
        <div class="columns large-3">
            <input type="submit" class="button postfix" value="Продолжить">
        </div>
    </div>
</form>
<p class="text-center">
    Регистрируясь вы соглашаетесь с <a href="#">условиями использования</a>. Все персональные данные конфеденциальны
</p>