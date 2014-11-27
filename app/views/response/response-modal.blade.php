@if($success)
<h2>Вы успешно оплатили!</h2>
<p class="lead">Осталось на счету: {{Auth::user()->credits}} <i class="fa fa-money"></i></p>

<div id="response-{{$response->id}}">
    @if($response->type == 'image')
        <img class="th" src="{{URL::to('response/get')}}/{{$response->id}}">
    @elseif($response->type == 'movie')
        <script type='text/javascript'>
            CodoPlayer('{{URL::to('response/get')}}/{{$response->id}}')
        </script>
    @elseif($response->type == 'audio')
        <script type='text/javascript'>
            CodoPlayer('{{URL::to('response/get')}}/{{$response->id}}')
        </script>
    @endif
</div>

<script>
    $('#response-container-{{$response->id}}').hide().parent().append(
        $('#response-{{$response->id}}').html()
    );
</script>
@else
    <h4>Недостаточно сретств</h4>
@endif
<a class="close-reveal-modal">&#215;</a>