<script src="{{URL::asset('js/ckeditor/ckeditor.js')}}"></script>

<h4><i class="fa fa-edit success"></i> Редактирование блока</h4>

<div class="divider"></div>

<form id="form-message-update" action="{{URL::to('admin/message/update')}}/{{$message->id}}" method="post">

    <dl class="tabs vertical" data-tab>
        <dd @if(Config::get('language') == 'ru') class="active" @endif><a href="#panel1a"><img src="{{URL::asset('img/ru.png')}}"> Руский</a></dd>
        <dd @if(Config::get('language') == 'ro') class="active" @endif><a href="#panel2a"><img src="{{URL::asset('img/ro.png')}}"> Romana</a></dd>
        <dd>
            <div class="divider"></div>
            <input class="button" type="submit" value="Сохранить">
        </dd>
    </dl>
    <div class="tabs-content vertical">
        <div class="content  @if(Config::get('language') == 'ru') active @endif" id="panel1a">
            <textarea id="input-message-ru" class="ckeditor" name="text_ru">{{$message->text_ru}}</textarea>
        </div>
        <div class="content  @if(Config::get('language') == 'ro') active @endif" id="panel2a">
            <textarea id="input-message-ro" class="ckeditor" name="text_ro">{{$message->text_ro}}</textarea>
        </div>
    </div>


</form>


<a class="close-reveal-modal">&#215;</a>

<script>
    var language = "{{Config::get('language')}}";

    var options = {'filebrowserBrowseUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/browse.php?type=files',
        'filebrowserImageBrowseUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/browse.php?type=images',
        'filebrowserFlashBrowseUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/browse.php?type=flash',
        'filebrowserUploadUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/upload.php?type=files',
        'filebrowserImageUploadUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/upload.php?type=images',
        'filebrowserFlashUploadUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/upload.php?type=flash',
        'language': language//,
        //'enterMode': 2
    };

    CKEDITOR.replace('text_ru', options);
    CKEDITOR.replace('text_ro', options);

    $('#form-message-update').ajaxForm({
        beforeSerialize: function() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        },
        success: function(data) {
            $("#message-" + data.message_id).html(
                $("#input-message-" + language).val()
            );
        }
    });

    $(document).foundation();

</script>