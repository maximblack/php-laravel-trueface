<tr class="quote-row" quote="{{$quote->id}}">
    <td class="quote-ru">{{$quote->quote_ru}}</td>
    <td class="quote-ro">{{$quote->quote_ro}}</td>
    <td class="author">{{$quote->author}}</td>
    <td>
        {{$quote->updated_at}}
    </td>
    <td>
        <i onclick="actionSwitchState({{$quote->id}})" class="fa state control fa-power-off {{$quote->confirmed ? "success" : ""}} switch-button">

        </i>
    </td>
    <td>
        <i onclick="actionView({{$quote->id}})" class="fa control fa-eye view"></i>
    </td>
    <td>
        <i onclick="actionDelete({{$quote->id}})" class="fa control fa-trash-o delete"></i>
    </td>
</tr>