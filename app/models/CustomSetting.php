<?php

class CustomSetting extends Eloquent {

    protected $table = 'settings';

    protected $fillable = array(
        'name',
        'value'
    );

}