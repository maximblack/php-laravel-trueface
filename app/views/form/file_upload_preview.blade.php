<li file="{{$file->id}}" class="text-center file-element">
    <a href="{{URL::asset('files')}}/{{$file->name}}"
       data-lightbox="{{$file->form_id}}">
        <img class="th" src="{{URL::asset('files')}}/{{$file->thumbnail}}">
    </a>

    <span onclick="deleteFile({{$file->id}})" class="file-delete">
        <i class="fa fa-trash-o"></i> Удалить
    </span>
</li>