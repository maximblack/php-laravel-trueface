<?php

class CustomQuote extends Eloquent {

    protected $table = 'quotes';

    protected $fillable = array(
        'quote_ru',
        'quote_ro',
        'author'
    );

}