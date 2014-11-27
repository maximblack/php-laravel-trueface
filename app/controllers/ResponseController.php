<?php

class ResponseController extends BaseController {

    public function my_responses() {

        $viewVariables['category'] = 'my';

        $responses = CustomResponse::author()->with(array(
            'form'
        ))->orderBy('updated_at', 'desc')->get();

        $viewVariables['responses'] = $responses;

        $this->layout->content = View::make('response.response', $viewVariables);

    }

    public function to_me_responses() {

        $viewVariables['category'] = 'to-me';

        $responses = CustomResponse::where('user_id_foreign', '=', Auth::user()->id)->with(array(
            'form'
        ))->orderBy('updated_at', 'desc')->get();

        $viewVariables['responses'] = $responses;

        $this->layout->content = View::make('response.response', $viewVariables);

    }

    public function addResponse() {

        $formId = Input::get('form_id');

        $file = Input::file('file');

        if($file) {

            $response = CustomResponse::create(array(
                'user_id' => Auth::user()->id,
                'user_id_foreign' => CustomForm::find($formId)->user_id,
                'form_id' => $formId
            ));

            $extension = $file->getClientOriginalExtension();

            $movieExtensions = array(
                'ogv',
                'mp4',
                'webm',
                'wmv',
            );

            $audioExtensions = array(
                'mp3',
                'wav',
                'wma',
            );

            $imageExtensions = array(
                'png',
                'jpeg',
                'jpg',
                'gif'
            );

            if(in_array($extension, $movieExtensions))
                $type = 'movie';
            if(in_array($extension, $audioExtensions))
                $type = 'audio';
            if(in_array($extension, $imageExtensions))
                $type = 'image';

            if(!isset($type))
                App::abort(401);

            $imageUploadName = str_random(30) . '.' . $extension;

            $imageUploadPath = Config::get('app.files_upload_path');

            $file->move($imageUploadPath, $imageUploadName);


            $response->name = $imageUploadName;
            $response->extension = $extension;
            $response->type = $type;

            $response->save();

            return Response::json(array(
                'success' => true,
                'file_type' => $type,
                'file_content' => (string)View::make('response.file_upload_preview', array(
                        'response' => $response,
                    )),
            ));

        }

        return Response::json('error', 400);

    }


    public function update($responseId) {

        $response = CustomResponse::find($responseId);

        $response->description = Input::get('description');

        $response->price =  Input::get('price');

        $response->save();

        return Response::json('success', 200);

    }

    public function get($responseId) {

        $response = CustomResponse::find($responseId);

        if($response->paid || $response->user_id == Auth::user()->id) {

            return Response::download(Config::get('app.files_upload_path') . '/' . $response->name);

        } else {
            return false;
        }

    }

}