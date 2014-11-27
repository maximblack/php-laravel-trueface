@extends('layout_2_columns')

@section('content-2')


<link rel="stylesheet" href="{{URL::asset('css/lightbox.css')}}">

<script src="{{URL::asset('js/SimpleAjaxUploader.min.js')}}"></script>
<script src="{{URL::asset('js/lightbox.min.js')}}"></script>


<div class="row">
    <div class="column small-12 content-block">
        <ul class="breadcrumbs">
            <li><a href="{{URL::to('forms')}}">Все формы</a></li>
            <li class="unavailable"><a href="#">Предыдущая</a></li>
            <li><a href="#">Следующая</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="column small-12 content-block form-view">
        <div class="columns large-4">
            <div class="row">
                <div class="column small-12 text-center">
                    @if($form->files[0])
                        <img class="image th" src="{{URL::asset('files')}}/{{$form->files[0]->thumbnail}}">
                    @else
                        <span class="image-none th">
                            Фотография отсутствует
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="column small-12">

                </div>
            </div>
        </div>
        <div class="columns large-8">
                <label>Имя</label>
                <h5>{{{$form->name ? $form->name : "Не указанно"}}}</h5>
                <hr>
                <label>Фамилия</label>
                <h5> {{{$form->surname ? $form->surname : "Не указанно"}}}</h5>
                <hr>
                <p>{{{$form->description ? str_limit($form->description, 80) : "Описание отсутствует"}}}</p>

                <ul class="large-block-grid-4">
                    @foreach($form->files as $image)
                    <li>
                        <img class="th" src="{{URL::asset('files')}}/{{$image->name}}">
                    </li>
                    @endforeach
                </ul>
        </div>
    </div>
</div>
    @if(true || $form->user_id != Auth::user()->id)
        <div class="row">
            <div class="columns large-4 multiple-columns">
                <div class="row">
                    <div class="column small-12 content-block">
                        <p>
                            Вы можете добавить фотографии, видео, записи звонков
                        </p>
                        <p>
                            После модерации администратором данные будут доступны автору формы
                        </p>
                    </div>
                </div>
            </div>
            <div class="columns large-8 multiple-columns last-column">
                <div data-alert class="alert-box">
                    Вы добавили информацию о данном человеке.
                    <a href="#" class="close">&times;</a>
                </div>
                <div class="row">
                    <div class="column small-12 content-block">
                        <div class="panel">
                            <ul id="upload-preview" class="large-block-grid-3">
                                @foreach($form->responses as $response)
                                    @include('response.file_upload_preview', array('response' => $response))
                                @endforeach
                            </ul>
                            <div id="file-upload" class="file-upload">
                                <i class="fa fa-plus-circle success"></i> <span>Добавить компромат</span>
                            </div>

                            <script>
                                var uploader = new ss.SimpleUpload({
                                    button: '#file-upload', // HTML element used as upload button
                                    url: '{{URL::to("response/add/")}}', // URL of server-side upload handler
                                    name: 'file', // Parameter name of the uploaded file,
                                    data: {
                                        form_id: '{{$form->id}}'
                                    },
                                    responseType: 'json',
                                    multipart: true,
                                    multiple: true,
                                    onComplete: function(filename, response) {
                                        if(response.success)
                                            $('#upload-preview').append(response.file_content);
                                    }
                                });

                                function deleteFile(id) {
                                    $.post( "{{URL::to('response/delete')}}", { file_id: id })
                                        .done(function( data ) {
                                            if(data.success)
                                                $('[file="' + id + '"]').remove();
                                        });
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif
@stop