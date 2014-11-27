<script src="{{URL::asset('js/jquery.tablesorter.min.js')}}"></script>
<script src="{{URL::asset('js/jquery-ias.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('css/table-sort.css')}}">

<div class="row">
    <div class="column small-12 content-block">
        <table class="tablesorter">
            <thead>
            <tr>
                <th>Автор</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Ответы</th>
                <th>Дата изменения</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="forms-container">
            @if(count($forms) == 0)
            <tr class="empty-row">
                <td colspan="8" class="text-center">
                    <h5>Список пуст</h5>
                </td>
            </tr>
            @endif
            @foreach($forms as $form)
            <tr class="form" form="{{$form->id}}">
                <td>
                    <a href="{{URL::to('admin/users/')}}/{{$form->user_id}}">{{$form->user->name}}</a>
                </td>
                <td>
                    {{$form->name}}
                </td>
                <td>
                    {{$form->surname}}
                </td>
                <td>
                    <a href="{{URL::to('responses/')}}/{{$form->id}}">
                        <i class="fa fa-external-link control"></i>
                    </a>
                </td>
                <td>
                    {{$form->created_at}}
                </td>
                <td class="text-center">
                    <i onclick="actionSwitchState({{$form->id}})" class="fa state control fa-power-off {{$form->confirmed ? "success" : ""}} switch-button">

                    </i>
                </td>
                <td>
                    <a href="{{URL::to('admin/form/view')}}/{{$form->id}}" data-reveal-id="modal-form-{{$form->id}}" data-reveal-ajax="true">
                        <i class="fa control fa-eye view"></i>
                    </a>
                    <div id="modal-form-{{$form->id}}" class="reveal-modal admin" data-reveal>

                    </div>
                    <script>
                        $(document).foundation();
                    </script>
                </td>
                <td>
                    <i onclick="actionDelete({{$form->id}})" class="fa control fa-trash-o delete"></i>
                </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        <?php echo $forms->links(); ?>
    </div>
</div>

<script>

    function actionSwitchState(id) {
        $.post( "{{URL::to('admin/form/switch-state')}}", { form_id: id })
            .done(function(data) {
                $('.state', $("[form=" + id + "]")).toggleClass('success');
                $('.tablesorter').trigger('update');
            });
    }

    function actionDelete(id) {
        $.post( "{{URL::to('admin/form/delete')}}", { form_id: id })
            .done(function( data ) {
                $('[form="' + id + '"]').remove();
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
        container:  '#forms-container',
        item:       '.form',
        pagination: '.pagination',
        next:       '.next'
    });

</script>