<script src="{{URL::asset('js/jquery.tablesorter.min.js')}}"></script>
<script src="{{URL::asset('js/jquery-ias.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('css/table-sort.css')}}">

<div class="row">
    <div class="column small-12 content-block">
        <h4>
            <i class="fa fa-plus-circle success"></i> Добавление цитаты
        </h4>
        <div class="row">
            <div class="columns large-8">

                <form id="form-quote-add" action="{{URL::to('admin/quote/add')}}" method="post">

                    <label><img src="{{URL::asset('img/ru.png')}}"> Текст цитаты на руском</label>
                    <textarea class="input-quote-ru" name="quote_ru"></textarea>

                    <label><img src="{{URL::asset('img/ro.png')}}"> Текст цитаты на румынском</label>
                    <textarea class="input-quote-ro" name="quote_ro"></textarea>

                    <label>Автор цитаты</label>

                    <input class="input-author" type="text" name="author">

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
            <i class="fa fa-list-ul success"></i> Список цитат
        </h4>
        <table class="tablesorter">
            <thead>
            <tr>
                <th>Quote</th>
                <th>Quote</th>
                <th>Author</th>
                <th>Дата изменения</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="rows-container">
            @if(count($quotes) == 0)
                <tr class="empty-row">
                   <td colspan="7" class="text-center">
                       <h5>Список цитат пуст</h5>
                   </td>
                </tr>
            @endif
            @foreach($quotes as $quote)
                @include('admin.partials.quote_row', array('quote' => $quote))
            @endforeach
    </tbody>
    </table>
    <?php echo $quotes->links(); ?>
</div>
</div>

<script>
    function actionSwitchState(id) {
        $.post( "{{URL::to('admin/quote/switch-state')}}", { quote_id: id })
            .done(function(data) {
                $('.state', $("[quote=" + id + "]")).toggleClass('success');
                $('.tablesorter').trigger('update');
            });
    }

    function actionDelete(id) {
        $.post( "{{URL::to('admin/quote/delete')}}", { quote_id: id })
            .done(function( data ) {
                $('[quote="' + id + '"]').remove();
            });
    }

    function actionView(id) {
            var quote = $('[quote="' + id + '"]');
            var form = $('#form-quote-add');
            console.log($('.input-quote-ru', form));
            $('.input-quote-ru', form).val($('.quote-ru', quote).html());
            $('.input-quote-ro', form).val($('.quote-ro', quote).html());
            $('.input-author', form).val($('.author', quote).html());
            form.attr('action', "{{URL::to('admin/quote/update')}}/" + id);
            $('html,body').animate({
                scrollTop: form.offset().top
            }, 1000);
    };

    $(".tablesorter").tablesorter({
        headers: {
            4: {sorter: false},
            5: {sorter: false},
            6: {sorter: false}
        }

    });

    $('#form-quote-add').ajaxForm({
        success: function(data) {
            var form = $('#form-quote-add');
            console.log(data);
            if(data.action == 'update') {
                var quote = $("[quote='" + data.quote_id + "']");

                $(".quote-ru", quote).html($('.input-quote-ru', form).val());
                $(".quote-ro", quote).html($('.input-quote-ro', form).val());

                $(".author", quote).html($('.input-author', form).val());

            } else {
                $('.empty-row').remove();
                $('#rows-container').append(data);
            }
            form.clearForm().attr('action', "{{URL::to('admin/quote/add')}}");
        }
    });

    var ias = jQuery.ias({
        container:  '#rows-container',
        item:       '.quote-row',
        pagination: '.pagination',
        next:       '.next'
    });

</script>