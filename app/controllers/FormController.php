<?php

class FormController extends BaseController {

    public function add() {

        $viewVariables = array();
        $viewVariables['action'] = 'add';

        $unfinishedForm = CustomForm::finished(false)->author()->first();
        if($unfinishedForm)
            return Redirect::to('form/delete/' . $unfinishedForm->id)->with('redirect', 'form/add');

        $form = CustomForm::create(array(
                'user_id' => Auth::user()->id
            )
        );

        $viewVariables['form'] = $form;

        $this->layout->content = View::make('form.add', $viewVariables);

    }

    public function addFile() {

        $formId = (int)Input::get('form_id');

        $file = Input::file('file');

        if($file) {

            $form = CustomForm::author()->whereId($formId)->first();

            if(!$form)
                App::abort(401);

            $extension = $file->getClientOriginalExtension();

            $imageUploadName = str_random(30) . '.' . $extension;

            $imageUploadPath = Config::get('app.public_files_path');

            $imageExtensions = array(
                'png',
                'jpeg',
                'jpg',
                'gif'
            );

            if(in_array($extension, $imageExtensions))
                $type = 'image';

            if(!isset($type))
                App::abort(401);

            $file->move($imageUploadPath, $imageUploadName);

            Image::make($imageUploadPath . $imageUploadName)->resize(300, null, true)->save($imageUploadPath . 'th-' . $imageUploadName);

            $file = FormsFiles::create(array(
                'form_id' => $form->id,
                'name' => $imageUploadName,
                'thumbnail' => 'th-' . $imageUploadName,
                'extension' => $extension,
                'type' => $type,
            ));

            return Response::json(array(
                'success' => true,
                'file_type' => 'image',
                'file_content' => (string)View::make('form.file_upload_preview', array(
                        'file' => $file,
                    )),
            ));

        }

        return Response::json('error', 400);

    }

    public function deleteFile() {

        $file_id = Input::get('file_id');

        $file = FormsFiles::where('id', "=", $file_id)->with(
            'form'
        )->first();

        if($file && ($file->form->user_id == Auth::user()->id || Auth::user()->admin)) {

            File::delete(Config::get('app.files_upload_path') . '/' . $file->name);

            File::delete(Config::get('app.files_upload_path') . '/' . $file->thumbnail);

            $file->delete();

            return Response::json(array(
                'success' => true
            ));

        }

        return Response::json(array(
            'success' => false,
        ));


    }

	public function edit($id = null)
	{

        $viewVariables = array();
        $viewVariables['action'] = 'edit';

        $form = CustomForm::author()->
            with('files')->
            whereId($id)->
            first();

        if(!$form)
            App::abort(401);

        $viewVariables['form'] = $form;

        $this->layout->content = View::make('form.add', $viewVariables);

	}

    public function update($id) {

        $validator = Validator::make(Input::all(), array(
            'name' => 'min:3|max:100',
        ));

        if($validator->passes()) {

            $form = CustomForm::author()->whereId($id)->update(array(
                'name' => Input::get('name'),
                'surname' => Input::get('surname'),
                'nickname' => Input::get('nickname'),
                'occupation' => Input::get('occupation'),
                'description' => Input::get('description'),
                'finished' => 1,
            ));

            return Redirect::to('form/edit/' . $id);

        }

        App::abort(401);

    }

    public function allForms() {

        $viewVariables = array();

        $viewVariables['filter'] = 'all';

        $forms = CustomForm::with('files')->
            orderBy('updated_at', 'desc')->
            get();

        $viewVariables['forms'] = $forms;
        $viewVariables['category'] = 'my';

        $this->layout->content = View::make('form.all', $viewVariables);

    }

    public function myForms($filter = null) {

        $viewVariables = array();

        $viewVariables['filter'] = 'my';

        $viewVariables['category'] = 'my';
        if($filter == 'date' || $filter == null) {
            $responses = CustomResponse::author()->with(array(
                'form'
            ))->orderBy('updated_at', 'desc')->get();
            $viewVariables['filter'] = 'date';
        } else if($filter == 'form_name') {
            $responses = CustomResponse::author()->with(array(
                'form' => function ($query) {
                        $query->orderBy('name', 'desc');
                    }
            ))->get();
            $viewVariables['filter'] = 'form_name';
        } else if($filter == 'paid') {
            $responses = CustomResponse::author()->with(array(
                'form'
            ))->where('paid', '=', 1)->get();
            $viewVariables['filter'] = 'paid';
        }

        $forms = CustomForm::with('files')->
            author()->
            orderBy('updated_at', 'desc')->
            get();

        $viewVariables['forms'] = $forms;

        $this->layout->content = View::make('form.all', $viewVariables);

    }

    public function delete($id) {

        $form = CustomForm::author()->whereId($id)->first();

        $files = FormsFiles::where('form_id', '=', $form->id)->get();

        foreach($files as $file) {
            File::delete(Config::get('app.files_upload_path') . '/' . $file->name);
        }

        FormsFiles::where('form_id', '=', $form->id)->delete();

        $form->delete();

        $redirect = Session::get('redirect');

        if($redirect)
            return Redirect::to($redirect);

        return Redirect::to('/');

    }

    public function view($id) {

        $form = CustomForm::with(array(
            'files' => function($query) {

                },
            'responses'
        ))->whereId($id)->first();

        $this->layout->content = View::make('form.view', array(
                    'form' => $form,

                ));

    }

}