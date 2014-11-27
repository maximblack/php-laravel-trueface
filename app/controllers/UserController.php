<?php

class UserController extends BaseController {

    protected $layout = 'user.layout';

    public function dashboard() {

        $this->layout->content = View::make('user.dashboard');

    }

    public function language_change($language) {

        Session::put('language', $language);

        return Redirect::back();

    }

	public function register($referralCode = null)
	{

        $contentVariables = array();

        $contentVariables['success'] = false;
        $contentVariables['referral'] = false;

        if(Request::isMethod('post')) {

            $validator = Validator::make(Input::all(), array(
                'email' => 'required|email',
                'referralCode' => 'size:40',
            ));

            if($validator->fails())
                return Redirect::back()->withErrors($validator);

            $email = Input::get('email');

            $user = User::where('email', '=', $email)->first();

            if($user) {
                $contentVariables['message_email_not_unique'] = 'Такой email уже зарегистрирован';
                $contentVariables['email'] = $email;
            } else {

                $confirmationCode = str_random(40);
                $randomReferralCode = str_random(40);

                $referralUser = User::where('referral_code', '=', $referralCode)->first();

                User::create(array(
                    'email' => $email,
                    'confirmation_code' => $confirmationCode,
                    'referral_code' => $randomReferralCode,
                    'referral_user_id' => $referralUser ? $referralUser->id : null,
                ));

                Mail::queue('emails.register', array(
                    'email' => $email,
                    'confirmationCode' => $confirmationCode,
                ), function($message) use($email)
                {
                    $message->to($email, 'Maxim')->subject('trueface - Регистрация');
                });

                $contentVariables['success'] = true;
                $contentVariables['email'] = $email;
                $tmp = explode('@', $email);
                $contentVariables['emailHost'] = $tmp[1];
            }

            $contentVariables['requestMethod'] = 'post';

        } else {

            $contentVariables['referral'] = false;

            if($referralCode) {

                $referralUser = User::where('referral_code', '=', $referralCode)->first();

                if($referralUser) {
                    $contentVariables['referral'] = true;
                    $contentVariables['referralName'] = $referralUser->name;
                    $contentVariables['referralCode'] = $referralCode;
                }


            }

            $contentVariables['requestMethod'] = 'get';

        }


        $this->layout->content = View::make('user.register', $contentVariables);

	}

    public function confirmRegistration($confirmationCode) {

        if(!$confirmationCode) return;

        if(Request::isMethod('post')) {

            $validator = Validator::make(Input::all(), array(
                'password' => 'required|min:6|max:50',
                'name' => 'required|min:3',
            ));

            if($validator->passes()) {


                $user = User::where('confirmation_code', '=', $confirmationCode)->first();
                $user->confirmation_code = '';
                $user->password = Hash::make(Input::get('password'));
                $user->name = Input::get('name');
                $user->phone = Input::get('phone');
                $user->save();

                Auth::login($user);

                return Redirect::to('/');

            }

        }

        $user = User::where('confirmation_code', '=', $confirmationCode)->first();

        $contentVariables = array();

        if(!$user) {
            $contentVariables['success'] = false;
        } else {
            $contentVariables['success'] = true;
            $contentVariables['email'] = $user->email;
            $contentVariables['confirmationCode'] = $confirmationCode;
        }

        $this->layout->content = View::make('user.confirm', $contentVariables);

    }

    public function login() {

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true))
        {
            return Redirect::to('/');
        } else {
            return Redirect::back();
        }

    }

    public function logout() {

        Auth::logout();

        return Redirect::to('/');
    }

}