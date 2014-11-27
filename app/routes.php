<?php

if(Auth::check()) {
    Route::get('/', 'UserController@dashboard');
} else {
    Route::get('/', 'HomeController@showWelcomePage');
}

Route::get('user/register/{referralCode?}', 'UserController@register');
Route::get('user/confirm/{confirmationCode}', 'UserController@confirmRegistration');

Route::get('forms', 'FormController@allForms');

Route::get('file/get/{id}/{hash?}', 'FileController@get');

Route::get('language/change/{language}', 'UserController@language_change');


Route::group(array('before' => 'csrf'), function()
{
    Route::post('user/register', 'UserController@register');
    Route::post('user/confirm/{confirmationCode}', 'UserController@confirmRegistration');
    Route::post('user/login', 'UserController@login');
});

Route::group(array(
    'before' => 'admin',
    'prefix' => 'admin'), function() {

    Route::get('/', 'AdminController@home');

    Route::get('message/edit/{id}', 'AdminController@message_edit');
    Route::post('message/update', 'AdminController@message_update');

    Route::get('translations', 'AdminController@translations');
    Route::post('translation/add', 'AdminController@translationAdd');
    Route::post('translation/delete', 'AdminController@translation_delete');
    Route::post('translation/update/{translation_id}', 'AdminController@translation_update');
    Route::post('translations/compile', 'AdminController@translations_compile');

    Route::get('forms', 'AdminController@forms');
    Route::get('responses', 'AdminController@responses');

    Route::get('users/{id?}', 'AdminController@users');
    Route::post('user/switch-state', 'AdminController@user_switch_state');
    Route::post('user/delete', 'AdminController@user_delete');

    Route::get('response/view/{id}', 'AdminController@responseView');
    Route::post('response/switch-state', 'AdminController@response_switch_state');
    Route::post('response/delete', 'AdminController@response_delete');

    Route::get('form/view/{id}', 'AdminController@formView');
    Route::post('form/switch-state', 'AdminController@form_switch_state');
    Route::post('form/delete', 'AdminController@form_delete');

    Route::get('quotes', 'AdminController@quotes');
    Route::post('quote/add', 'AdminController@quoteAdd');
    Route::post('quote/switch-state', 'AdminController@quote_switch_state');
    Route::post('quote/delete', 'AdminController@quote_delete');
    Route::post('quote/update/{quote_id}', 'AdminController@quote_update');

});

Route::group(array('before' => 'authenticated'), function()
{
    Route::get('user/coins', 'CoinController@coins');


    Route::get('user/logout', 'UserController@logout');

    Route::post('form/update/{id}', 'FormController@update')->where(array(
        'id' => '[0-9]+'
    ));
    Route::get('form/add', 'FormController@add');
    Route::get('form/edit/{id?}', 'FormController@edit')->where(array(
        'id' => '[0-9]+',
    ));
    Route::get('form/delete/{id}', 'FormController@delete')->where(array(
        'id' => '[0-9]+'
    ));
    Route::get('form/view/{id}', 'FormController@view');

    Route::post('form/add-file', 'FormController@addFile');

    Route::post('form/file/delete', 'FormController@deleteFile');

    Route::get('forms/my', 'FormController@myForms');

    Route::post('response/add', 'ResponseController@addResponse');

    Route::get('responses/my', 'ResponseController@my_responses');

    Route::get('responses/to-me', 'ResponseController@to_me_responses');

    Route::post('response/update/{responseId}', 'ResponseController@update');

    Route::get('response/get/{responseId}', 'ResponseController@get');

    Route::get('response/pay/{id}', 'CoinController@pay');
});
