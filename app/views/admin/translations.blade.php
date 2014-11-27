<script src="{{URL::asset('js/jquery.tablesorter.min.js')}}"></script>
<script src="{{URL::asset('js/jquery-ias.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('css/table-sort.css')}}">

<div class="row">
    <div class="column small-12 content-block">
        <h4>
            <i class="fa fa-plus-circle success"></i> Добавление словосочетания
        </h4>
        <div class="row">
            <div class="columns large-8">

                <form id="form-translation-add" action="{{URL::to('admin/translation/add')}}" method="post">
                    <label>Кодовое слово</label>
                    <input class="input-name" type="text" name="name">

                    <label><img src="{{URL::asset('img/ru.png')}}"> Руский</label>
                    <input class="input-name-ru" type="text" name="name_ru">

                    <label><img src="{{URL::asset('img/ro.png')}}"> Romana</label>
                    <input class="input-name-ro" type="text" name="name_ro">

                    <input type="submit" class="button tiny" value="Сохранить">
                </form>
            </div>
            <div class="columns large-4">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="column small-12 content-block">
        <h4>
            <i class="fa fa-bolt success"></i>
            Компиляция
        </h4>
        <p>
            Чтобы сохранить изменения требуется компиляция языковых файлов
        </p>
        <form id="form-compile" action="{{URL::to('admin/translations/compile')}}" method="post">
            <input class="button tiny success" type="submit" value="Компиляция">
            <i style="display: none" class="fa fa-spinner fa-spin control"></i>
            <span style="display: none">Компиляция завершена успешно</span>
        </form>
    </div>
</div>

<div class="row">
    <div class="column small-12 content-block">
        <h4>
            <i class="fa fa-list-ul success"></i> Список слов
        </h4>
        <table class="tablesorter">
            <thead>
            <tr>
                <th>Name</th>
                <th>Руский</th>
                <th>Romana</th>
                <th>Дата изменения</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="rows-container">
            @if(count($translations) == 0)
                <tr class="empty-row">
                   <td colspan="6" class="text-center">
                       <h5>Список пуст</h5>
                   </td>
                </tr>
            @endif
            @foreach($translations as $translation)
                @include('admin.partials.translation_row', array('translation' => $translation))
            @endforeach
    </tbody>
    </table>
    <?php echo $translations->links(); ?>
</div>
</div>

<script>

    function actionDelete(id) {
        $.post( "{{URL::to('admin/translation/delete')}}", { translation_id: id })
            .done(function( data ) {
                $('[translation="' + id + '"]').remove();
            });
    }

    $(".tablesorter").tablesorter({
        headers: {
            4: {sorter: false},
            5: {sorter: false}
        }

    });

    function actionView(id) {
        var translation = $('[translation="' + id + '"]');
        var form = $('#form-translation-add');
        $('.input-name', form).val($('.name', translation).html());
        $('.input-name-ru', form).val($('.name-ru', translation).html());
        $('.input-name-ro', form).val($('.name-ro', translation).html());

        form.attr('action', "{{URL::to('admin/translation/update')}}/" + id);
        $('html,body').animate({
            scrollTop: form.offset().top
        }, 1000);
    };

    $('#form-translation-add').ajaxForm({
        success: function(data) {
            var form = $('#form-translation-add');
            if(data.action == 'update') {
                var translation = $("[translation='" + data.translation_id + "']");
                $(".name", translation).html($('.input-name', form).val());
                $(".name-ru", translation).html($('.input-name-ru', form).val());
                $(".name-ro", translation).html($('.input-name-ro', form).val());
            }
            $('.empty-row').remove();
            $('#rows-container').append(data);
            form.clearForm().attr('action', "{{URL::to('admin/translation/add')}}");
        }
    });

    $('#form-compile').ajaxForm({
        beforeSubmit: function() {
            var form = $('#form-compile');
            $('.button', form).hide();
            $('.fa', form).show();
        },
        success: function(data) {
            var form = $('#form-compile');
            $('.button', form).show();
            $('.fa', form).hide();
            $('span', form).show();
        }
    });

    var ias = jQuery.ias({
        container:  '#rows-container',
        item:       '.translate-row',
        pagination: '.pagination',
        next:       '.next'
    });

</script>