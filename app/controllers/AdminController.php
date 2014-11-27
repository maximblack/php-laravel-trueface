<?php

class AdminController extends BaseController {

    protected $layout = 'admin.layout';

	public function home() {

        $this->layout->content = View::make('admin.home');

    }

    public function users($id = null) {

        if($id)
            $users = User::where('id', '=', $id);
        else
            $users = User::orderBy('created_at', 'desc');

        $users = $users->paginate(15);

        $this->layout->content = View::make('admin.users', array(
            'users' => $users
        ));

    }

    public function user_switch_state() {

        $user_id = Input::get('user_id');

        $user = User::find($user_id);

        $user->admin = !$user->admin;

        $user->save();

        return Response::json(array(
            'user_id' => $user_id,
            'user_state' => (int) $user->admin,
        ));

    }

    public function user_delete() {

        $user_id = Input::get('user_id');

        $user = User::find($user_id);

        $user->delete();

        return Response::json(array(
            'user_id' => $user_id,
        ));

    }

    public function forms() {

        $forms = CustomForm::with(array(
            'user'
        ))->orderBy('created_at', 'desc')
            ->paginate(2);

        $this->layout->content = View::make('admin.forms', array(
            'forms' => $forms,
        ));

    }

    public function responses() {

        $responses = CustomResponse::with(array(
            'user',
            'user_foreign',
            'form'
        ))->orderBy('created_at', 'desc')
            ->paginate(4);

        $this->layout->content = View::make('admin.responses', array(
            'responses' => $responses,
        ));

    }

    public function responseView($id) {

        $response = CustomResponse::with('form')->where('id', '=', $id)->first();

        return View::make('admin.response-view', array(
            'response' => $response,
        ));

    }

    public function response_switch_state() {

        $response_id = Input::get('response_id');

        $response = CustomResponse::find($response_id);

        $response->confirmed = !$response->confirmed;

        $response->save();

        return Response::json(array(
            'response_id' => $response_id,
            'response_state' => (int) $response->confirmed,
        ));

    }

    public function response_delete() {

        $response_id = Input::get('response_id');

        $response = CustomResponse::find($response_id);

        $response->delete();

        return Response::json(array(
            'response_id' => $response_id,
        ));

    }

    public function formView($id) {

        $form = Customform::with('files')->where('id', '=', $id)->first();

        return View::make('admin.form-view', array(
            'form' => $form,
        ));

    }

    public function form_switch_state() {

        $form_id = Input::get('form_id');

        $form = CustomForm::find($form_id);

        $form->confirmed = !$form->confirmed;

        $form->save();

        return Response::json(array(
            'form_id' => $form_id,
            'form_state' => (int) $form->confirmed,
        ));

    }

    public function form_delete() {

        $form_id = Input::get('form_id');

        CustomResponse::where('form_id', '=', $form_id)->delete();

        FormsFiles::where('form_id', '=', $form_id)->delete();

        $form = CustomForm::find($form_id);

        $form->delete();

        return Response::json(array(
            'form_id' => $form_id,
        ));

    }

    public function quotes() {

        $quotes = CustomQuote::paginate(1);

        $this->layout->content = View::make('admin.quotes', array(
            'quotes' => $quotes,
        ));

    }

    public function quoteAdd() {

        $quote_ru = Input::get('quote_ru');
        $quote_ro = Input::get('quote_ro');
        $author = Input::get('author');

        $quote = CustomQuote::create(array(
            'quote_ru' => $quote_ru,
            'quote_ro' => $quote_ro,
            'author' => $author
        ));

        return View::make('admin.partials.quote_row', array(
            'quote' => $quote,
        ));

    }

    public function quote_switch_state() {

        $quote_id = Input::get('quote_id');

        $quote = CustomQuote::find($quote_id);

        $quote->confirmed = !$quote->confirmed;

        $quote->save();

        return Response::json(array(
            'quote_id' => $quote_id,
            'quote_state' => (int) $quote->confirmed,
        ));

    }

    public function quote_delete() {

        $quote_id = Input::get('quote_id');

        $quote = CustomQuote::find($quote_id);

        $quote->delete();

        return Response::json(array(
            'quote_id' => $quote_id,
        ));

    }

    public function quote_update($quote_id) {

        $quote = CustomQuote::find($quote_id);

        $quote->quote_ru = Input::get('quote_ru');

        $quote->quote_ro = Input::get('quote_ro');

        $quote->author = Input::get('author');

        $quote->save();

        return Response::json(array(
            'action' => 'update',
            'quote_id' => $quote_id
        ));

    }

    public function translations() {

        $translations = CustomTranslation::orderBy('updated_at', 'desc')->paginate(10);

        $this->layout->content = View::make('admin.translations', array(
            'translations' => $translations,
        ));

    }

    public function translationAdd() {

        $name = Input::get('name');
        $name_ru = Input::get('name_ru');
        $name_ro = Input::get('name_ro');

        $translation = CustomTranslation::create(array(
            'name' => $name,
            'name_ru' => $name_ru,
            'name_ro' => $name_ro,
        ));

        return View::make('admin.partials.translation_row', array(
            'translation' => $translation,
        ));

    }

    public function translation_delete() {

        $translation_id = Input::get('translation_id');

        $translation = CustomTranslation::find($translation_id);

        $translation->delete();

        return Response::json(array(
            'translation_id' => $translation_id,
        ));

    }

    public function translation_update($translation_id) {

        $translation = CustomTranslation::find($translation_id);

        $translation->name = Input::get('name');
        $translation->name_ru = Input::get('name_ru');
        $translation->name_ro = Input::get('name_ro');

        $translation->save();

        return Response::json(array(
            'action' => 'update',
            'translation_id' => $translation_id
        ));

    }

    public function translations_compile() {

        $translations = CustomTranslation::all();

        $ru = $ro = "<?php\n\nreturn array(\n";

        foreach($translations as $translation) {
            $ru .= "\t'" . $translation->name . "' => '" . $translation->name_ru . "', \n";
            $ro .= "\t'" . $translation->name . "' => '" . $translation->name_ro . "', \n";
        }

        $ru .= ");";
        $ro .= ");";

        File::put(app_path() . '/lang/ru/messages.php', $ru);
        File::put(app_path() . '/lang/ro/messages.php', $ro);

        return Response::json(array(
            'success' => true,
        ));

    }

    public function message_edit($message_id) {

        $message = CustomMessage::find($message_id);

        return View::make('admin.partials.message_edit', array(
            'message' => $message
        ));

    }

    public function message_update() {

        $message = CustomMessage::find(Input::get('message_id'));

        $language = 'text_' . Config::get('language');

        $message[$language] = Input::get('message');

        $message->save();

        return Response::json(array(
            'message_id' => $message->id,
        ));

    }

}