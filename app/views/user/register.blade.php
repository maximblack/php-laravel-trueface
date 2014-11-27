<div class="row">
    <div class="column small-12 content-block">
            <div class="row">
                <div id="register-block" class="column small-12 content-block">
                    @if(!$success)
                    <h3>Бесплатная регистрация</h3>
                    <p class="text-center">
                        Регистрируясь вы соглашаетесь с <a href="#">условиями использования</a>. Все персональные данные конфеденциальны
                    </p>
                    <div class="row">
                        <div class="column small-8 small-centered">
                            <form action="{{URL::to('user/register')}}" method="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                @if(isset($referral) && $referral)
                                    <input type="hidden" name="referralCode" value="{{isset($referralCode) ? $referralCode : ''}}">

                                    <div class="row collapse">
                                        <div class="columns large-3">
                                            <span class="prefix">Реферрал</span>
                                        </div>
                                        <div class="columns large-9">
                                            <input type="text" name="referralName" value="{{isset($referralName) ? $referralName : ''}}" disabled>
                                        </div>
                                    </div>
                                @endif
                                <div class="row collapse">
                                    <div class="columns large-1">
                                        <span class="prefix">@</span>
                                    </div>
                                    <div class="columns large-8">
                                        <input type="email" name="email" @if(isset($email)) value="{{$email}}" @endif placeholder="ваш email">
                                    </div>
                                    <div class="columns large-3">
                                        <input type="submit" class="button postfix" value="Продолжить">
                                    </div>
                                </div>
                            </form>
                            @if(isset($message_email_not_unique))
                                <p class="error">{{$message_email_not_unique}}</p>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($success)
                    <p>На ваш электронный ящик <a href="http://{{$emailHost}}">{{isset($email) ? $email : ''}}</a>
                        высланна ссылка для потверждения. Проверьте вашу почту чтобы завершить регистрацию. Перейти на
                        <a href="http://{{$emailHost}}">{{$emailHost}}</a></p>
                    @endif
                </div>
            </div>


    </div>
</div>