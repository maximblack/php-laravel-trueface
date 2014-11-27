<?php
    Widget::register('count_my_forms', function($action = 'array'){

        static $values = array(
            'total_count',
            'new_count',
            'update' => true,
        );

        if($values['update']) {
            $values['new_count'] = CustomResponse::author()->
                where('user_id_foreign', '=', Auth::user()->id)->
                where('paid', '=', 0)->count();
            $values['total_count'] = CustomForm::author()->count();
            $values['update'] = false;
        }
        
        switch($action) {
        
           case 'total_count':
           	return $values['total_count'];
           case 'new_count':
           	return $values['new_count'];
           default:
           	return $values;
        
        }

    });

    Widget::register('count_my_responses', function($action = 'array'){

        static $values = array(
            'total_count',
            'new_count',
            'update' => true,
        );

        if($values['update']) {
            $values['new_count'] = CustomResponse::author()->where('paid', '=', 1)->where('viewed', '=', 0)->count();
            $values['total_count'] = CustomResponse::author()->count();
            $values['update'] = false;
        }

        switch($action) {
        
           case 'total_count':
           	return $values['total_count'];
           case 'new_count':
           	return $values['new_count'];
           default:
           	return $values;
        
        }

    });

    Widget::register('admin_forms_unconfirmed_count', function($action = 'array') {

        static $values = array(
            'total_count',
            'new_count',
            'update' => true,
        );

        if($values['update']) {
            $values['new_count'] = CustomForm::where('confirmed', '=', 0)->count();
            $values['total_count'] = CustomForm::all()->count();;
            $values['update'] = false;
        }

        switch($action) {

            case 'total_count':
                return $values['total_count'];
            case 'new_count':
                return $values['new_count'];
            default:
                return $values;

        }

    });

    Widget::register('admin_responses_unconfirmed_count', function($action = 'array') {

        static $values = array(
            'total_count',
            'new_count',
            'update' => true,
        );

        if($values['update']) {
            $values['new_count'] = CustomResponse::where('confirmed', '=', 0)->count();
            $values['total_count'] = CustomResponse::all()->count();;
            $values['update'] = false;
        }

        switch($action) {

            case 'total_count':
                return $values['total_count'];
            case 'new_count':
                return $values['new_count'];
            default:
                return $values;

        }

    });

    Widget::register('users_count', function(){
        return User::count();
    });

    Widget::register('admin_quotes_count', function() {
       return CustomQuote::count();
    });

    Widget::register('message', function($name) {

        $message = CustomMessage::firstOrCreate(array(
            'name' => $name,
        ));

        return View::make('admin.partials.message_link', array(
            'message' => $message
        ));


    });

    Widget::register('quote', function() {
        $quote = CustomQuote::orderBy(DB::raw('RAND()'))->first();
        return View::make('partials.quote', array(
            'quote' => $quote,
        ));
    });


    Widget::register('coin_md5', function($array) {
        array_push($array, 'Trueface321');
        $prehash = implode("::", $array);
        return md5($prehash);
    });