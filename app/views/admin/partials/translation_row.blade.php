<tr class="translation-row" translation="{{$translation->id}}">
    <td class="name">{{$translation->name}}</td>
    <td class="name-ru">{{$translation->name_ru}}</td>
    <td class="name-ro">{{$translation->name_ro}}</td>
    <td>
        {{$translation->updated_at}}
    </td>
    <td>
        <i onclick="actionView({{$translation->id}})" class="fa control fa-eye view"></i>
    </td>
    <td>
        <i onclick="actionDelete({{$translation->id}})" class="fa control fa-trash-o delete"></i>
    </td>
</tr>