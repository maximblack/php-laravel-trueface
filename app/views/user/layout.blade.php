@extends('layout')

@section('content')
    <div class="row">
        <div class="column large-7 small-12 multiple-columns">
            {{$content}}
        </div>
        <div class="columns large-5 small-12 multiple-columns last-column">
            <div class="row">
                <div class="column small-12 content-block">
                    {{Widget::quote()}}
                </div>
            </div>
            <div class="row">
                <div class="column small-12 content-block">
                    {{Widget::message('user-page-right-column')}}
                </div>
            </div>
        </div>
    </div>
@stop