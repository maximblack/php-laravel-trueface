<li file="{{$response->id}}" class="text-center file-element">
    <a href="{{URL::to('response/get/')}}/{{$response->id}}"
       data-lightbox="{{$response->form_id}}">
        <img class="th" src="{{URL::to('response/get/')}}/{{$response->id}}">
    </a>

    <span onclick="deleteFile({{$response->id}})" class="file-delete">
        <i class="fa fa-trash-o"></i> Удалить
    </span>
</li>