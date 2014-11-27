@extends('layout_2_columns')

@section('content-2')
        <link rel="stylesheet" href="{{URL::asset('css/lightbox.css')}}">

        <script src="{{URL::asset('js/SimpleAjaxUploader.min.js')}}"></script>
        <script src="{{URL::asset('js/lightbox.min.js')}}"></script>

        <div class="row">
            <div class="column small-12 content-block">
                <div class="row">
                    <div class="columns large-6">
                        <h4>
                            <i class="fa fa-plus-circle success"></i>
                            {{$action == 'add' ? 'Добавление анкеты' : 'Редактирование анкеты'}}
                        </h4>
                    </div>
                    <div class="columns large-6 column-info text-right">
                        @if($form->finished && !$form->confirmed)
                            <span class="label">
                                <i class="fa fa-cog fa-spin pull-left"></i>
                                Проверяется модератором
                            </span>
                        @elseif($form->finished && $form->confirmed)
                            <span class="label success">
                                Ожидание оплаты
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="columns large-8">
                        <form action="{{URL::to('form/update/')}}/{{$form ? $form->id : ''}}" method="post">
                            <div class="row">
                                <div class="column small-6">
                                    <label>Имя
                                        <input type="text" name="name" value="{{{$form ? $form->name : ''}}}" placeholder="Имя">
                                    </label>
                                </div>
                                <div class="column small-6">
                                    <label>Фамилия
                                        <input type="text" name="surname" value="{{{$form ? $form->surname : ''}}}" placeholder="Фамилия">
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column small-6">
                                    <label>Кличка
                                        <input type="text" name="nickname" value="{{{$form ? $form->nickname : ''}}}" placeholder="Кличка">
                                    </label>
                                </div>
                                <div class="column small-6">
                                    <label>Род занятий
                                        <input type="text" name="occupation" value="{{{$form ? $form->occupation : ''}}}" placeholder="Род занятии">
                                    </label>
                                </div>
                            </div>
                            <!--
                            <div class="row">
                                <div class="column small-12">
                                    <dl class="tabs" data-tab>
                                        <dd class="active"><a href="#social-facebook">Tab 1</a></dd>
                                        <dd><a href="#social-twitter">Tab 2</a></dd>
                                        <dd><a href="#social-google-plus">Tab 3</a></dd>
                                        <dd><a href="#social-odnoklassniki">Tab 4</a></dd>
                                    </dl>
                                    <div class="tabs-content">
                                        <div class="content active" id="social-facebook">
                                            <p>First panel content goes here...</p>
                                        </div>
                                        <div class="content" id="social-twitter"panel2-2">
                                            <p>Second panel content goes here...</p>
                                        </div>
                                        <div class="content" id="social-google-plus">
                                            <p>Third panel content goes here...</p>
                                        </div>
                                        <div class="content" id="social-odnoklassniki">
                                            <p>Fourth panel content goes here...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            -->
                            <div class="row">
                                <div class="column small-12">
                                    <label>Дополнительная информация
                                        <textarea name="description">{{{$form ? $form->description : ''}}}</textarea>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column small-12">
                                    <label>Фото, видео</label>
                                    <div class="panel">
                                        <ul id="upload-preview" class="large-block-grid-3">
                                            @foreach($form->files as $file)
                                                @include('form.file_upload_preview', array('file' => $file, 'form_id' => $form->id))
                                            @endforeach
                                        </ul>
                                        <div id="file-upload" class="file-upload">
                                            <i class="fa fa-plus-circle success"></i> <span>Добавить изображение</span>
                                        </div>

                                        <script>
                                            var uploader = new ss.SimpleUpload({
                                                button: '#file-upload', // HTML element used as upload button
                                                url: '{{URL::to("form/add-file/")}}', // URL of server-side upload handler
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
                                                $.post( "{{URL::to('form/file/delete')}}", { file_id: id })
                                                    .done(function( data ) {
                                                        if(data.success)
                                                            $('[file="' + id + '"]').remove();
                                                    });
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!--
                            <script src="{{URL::asset('js/dropzone.js')}}"></script>
                            <script>
                                Dropzone.autoDiscover = false;
                                $("#dropzone").dropzone({
                                    url: '{{URL::to("form/add-file/")}}/{{($form) ? $form->id : ""}}',
                                    maxFiles: 6,
                                    addRemoveLinks: true,
                                    dictDefaultMessage: 'Перетащите фаилы сюда или просто кликните'
                                });
                            </script>
                            -->
                            <div class="divider"></div>
                            <div class="row">
                                <div class="column small-12">
                                    <input type="submit" class="button" value="Сохранить">
                                    <a href="{{URL::to('form/delete')}}/{{$form ? $form->id : ""}}" class="button alert">Удалить</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="columns large-4">
                        {{Widget::message('form-edit-right-column')}}
                    </div>
                </div>
            </div>
        </div>
@stop