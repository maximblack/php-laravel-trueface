@if(Auth::check() && Auth::user()->admin)
    <div id="message-{{$message->id}}" class="admin-message" contenteditable="true">

@endif

        @if(Config::get('language') == 'ru')
            {{$message->text_ru}}
        @else
            {{$message->text_ro}}
        @endif

@if(Auth::check() && Auth::user()->admin)
    </div>

<script>
    CKEDITOR.inline('message-{{$message->id}}', {
        'filebrowserBrowseUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/browse.php?type=files',
        'filebrowserImageBrowseUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/browse.php?type=images',
        'filebrowserFlashBrowseUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/browse.php?type=flash',
        'filebrowserUploadUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/upload.php?type=files',
        'filebrowserImageUploadUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/upload.php?type=images',
        'filebrowserFlashUploadUrl':'{{URL::asset('js')}}/ckeditor/kcfinder/upload.php?type=flash',
        on: {
            blur: function( event ) {

                var params = {
                    message_id: '{{$message->id}}',
                    message: event.editor.getData()
                };

                $.ajax({
                    url: '{{URL::to("admin/message/update")}}',
                    type: "POST",
                    data: params,
                    success: function(result) {
                        console.log(result);
                    }
                });

            }
        }
    });
</script>

@endif