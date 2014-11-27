<?php

class FileController extends BaseController {

    public function add($folderId) {

        $file = Input::file('file');

        if($file) {

            $folder = Folder::author()->whereId($folderId)->first();

            if(!$folder)
                App::abort(401);

            $extension = $file->getClientOriginalExtension();

            $imageUploadName = str_random(30) . '.' . $extension;

            $imageUploadPath = Config::get('app.files_upload_path');

            $type = $file->getMimeType();

            $file->move($imageUploadPath, $imageUploadName);

            CustomFile::create(array(
                'folder_id' => $folderId,
                'name' => $imageUploadName,
                'extension' => $extension,
                'type' => $type,
            ));

            return Response::json('success', 200);

        }

        return Response::json('error', 400);

    }

    public function addResponse($formId) {

        $formId = (int)$formId;

        $file = Input::file('file');

        if($file) {

            $response = CustomResponse::author()->where('form_id', '=', (int)$formId)->first();

            if(!$response)
                $response = CustomResponse::create(array(
                    'user_id' => Auth::user()->id,
                    'foreign_user_id' => Form::find($formId)->user_id,
                    'form_id' => $formId,
                    'folder_id' => Folder::create(array(
                            'user_id' => Auth::user()->id
                        ))->id
                ));

            $folder = Folder::author()->whereId($response->folder_id)->first();

            if(!$folder)
                App::abort(401);

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

            CustomFile::create(array(
                'folder_id' => $folder->id,
                'name' => $imageUploadName,
                'extension' => $extension,
                'type' => $type,
            ));

            return Response::json('success', 200);

        }

        return Response::json('error', 400);

    }

    public function get($id) {

        $file = CustomFile::find($id);

        if($file)
            return Response::download(Config::get('app.files_upload_path') . '/' . $file->name);

    }

}
