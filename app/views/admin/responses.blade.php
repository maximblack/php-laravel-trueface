<script src="{{URL::asset('js/jquery.tablesorter.min.js')}}"></script>
<script src="{{URL::asset('js/jquery-ias.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('css/table-sort.css')}}">

<div class="row">
    <div class="column small-12 content-block">
        <h4>
            <i class="fa fa-list-ul success"></i> Список ответов на формы
        </h4>
        <table class="tablesorter">
            <thead>
            <tr>
                <th>Автор</th>
                <th>Получатель</th>
                <th>Тип</th>
                <th>Цена</th>
                <th>Дата изменения</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="responses-container">
            @if(count($responses) == 0)
            <tr class="empty-row">
                <td colspan="8" class="text-center">
                    <h5>Список пуст</h5>
                </td>
            </tr>
            @endif
            @foreach($responses as $response)
            <tr class="response" response="{{$response->id}}">
                <td>
                    <a href="{{URL::to('admin/users/')}}/{{$response->user_id}}">{{$response->user->name}}</a>
                </td>
                <td>
                    <a href="{{URL::to('admin/users/')}}/{{$response->user_id_foreign}}">{{$response->user_foreign->name}}</a>
                </td>
                <td>
                    @if($response->type == 'image')
                        Изображение
                    @elseif($response->type == 'movie')
                        Видеофайл
                    @elseif($response->type == 'audio')
                        Аудиофайл
                    @endif
                </td>
                <td>
                    {{$response->price}} <i class="fa fa-money"></i>
                </td>
                <td>
                    {{$response->updated_at}}
                </td>
                <td>
                    <i onclick="actionSwitchState({{$response->id}})" class="fa state control fa-power-off {{$response->confirmed ? "success" : ""}} switch-button">

                    </i>
                </td>
                <td>
                    <a href="{{URL::to('admin/response/view')}}/{{$response->id}}" data-reveal-id="modal-response-{{$response->id}}" data-reveal-ajax="true">
                        <i class="fa control fa-eye view"></i>
                    </a>
                    <div id="modal-response-{{$response->id}}" class="reveal-modal admin" data-reveal>

                    </div>
                    <script>
                        $(document).foundation();
                    </script>
                </td>
                <td>
                    <i onclick="actionDelete({{$response->id}})" class="fa control fa-trash-o delete"></i>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <?php echo $responses->links(); ?>
    </div>
</div>

<script>

    function actionSwitchState(id) {
        $.post( "{{URL::to('admin/response/switch-state')}}", { response_id: id })
            .done(function(data) {
                $('.state', $("[response=" + id + "]")).toggleClass('success');
                $('.tablesorter').trigger('update');
            });
    }

    function actionDelete(id) {
        $.post( "{{URL::to('admin/response/delete')}}", { response_id: id })
            .done(function( data ) {
                $('[response="' + id + '"]').remove();
            });
    }


    $(".tablesorter").tablesorter({
        headers: {
            5: {sorter: false},
            6: {sorter: false},
            7: {sorter: false}
        }

    });

    var ias = jQuery.ias({
        container:  '#responses-container',
        item:       '.response',
        pagination: '.pagination',
        next:       '.next'
    });

</script>