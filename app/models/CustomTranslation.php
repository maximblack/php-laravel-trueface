<?php

class CustomTranslation extends Eloquent {

    protected $table = 'localisation';

    protected $fillable = array(
        'name',
        'name_ru',
        'name_ro'
    );

}