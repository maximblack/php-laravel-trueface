<script src="{{URL::asset('js/jquery.tablesorter.min.js')}}"></script>
<script src="{{URL::asset('js/jquery-ias.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('css/table-sort.css')}}">


<div class="row">
    <div class="column small-12 content-block">
        <div class="row">
            <div class="columns large-8">
                <h4>
                    <i class="fa fa-list-ul success"></i> Список пользователей
                </h4>
            </div>
            <div class="columns large-4 column-info">
                Всего пользователей
            </div>
        </div>

        <table class="tablesorter">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Дата регистрации</th>
                <th>Формы</th>
                <th>Компромат</th>
                <th>Админ</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="users-container">
            @if(count($users) == 0)
            <tr class="empty-row">
                <td colspan="8" class="text-center">
                    <h5>Список пуст</h5>
                </td>
            </tr>
            @endif
            @foreach($users as $user)
            <tr class="user" user="{{$user->id}}">
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    {{$user->created_at}}
                </td>
                <td>
                    <a href="#">
                        <i class="fa fa-external-link control"></i>
                    </a>
                </td>
                <td>
                    <a href="#">
                        <i class="fa fa-external-link control"></i>
                    </a>
                </td>
                <td>
                    <span onclick="actionSwitchState({{$user->id}})" class="control label {{$user->confirmed ? "success" : ""}}">Админ</span>
                </td>
                <td>
                    <a href="{{URL::to('admin/user/view')}}/{{$user->id}}" data-reveal-id="modal-user-{{$user->id}}" data-reveal-ajax="true">
                        <i class="fa control fa-eye view"></i>
                    </a>
                    <div id="modal-user-{{$user->id}}" class="reveal-modal admin" data-reveal>

                    </div>
                    <script>
                        $(document).foundation();
                    </script>
                </td>
                <td>
                    <i onclick="actionDelete({{$user->id}})" class="fa control fa-trash-o delete"></i>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <?php echo $users->links(); ?>
    </div>
</div>


<script>

    function actionSwitchState(id) {
        $.post( "{{URL::to('admin/user/switch-state')}}", { user_id: id })
            .done(function(data) {
                $('.state', $("[user=" + id + "]")).toggleClass('success');
                $('.tablesorter').trigger('update');
            });
    }

    function actionDelete(id) {
        $.post( "{{URL::to('admin/user/delete')}}", { user_id: id })
            .done(function( data ) {
                $('[user="' + id + '"]').remove();
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
        container:  '#users-container',
        item:       '.user',
        pagination: '.pagination',
        next:       '.next'
    });

</script>