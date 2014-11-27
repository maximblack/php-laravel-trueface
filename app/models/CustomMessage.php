<?php

class CustomMessage extends Eloquent {

    protected $table = 'messages';

    protected $fillable = array(
        'name',
        'name_ru',
        'name_ro'
    );



}