<?php

class FormsFiles extends Eloquent {

    protected $table = 'forms_files';

    protected $fillable = array(
        'form_id',
        'name',
        'thumbnail',
        'extension',
        'type',
        'size'
    );

    public function scopeAuthor($query) {
        return $query->where('user_id', '=', Auth::user()->id);
    }

    public function scopeWhereId($query, $id) {
        return $query->where('id', '=', $id);
    }

    public function scopeImages($query) {
        return $query->where('type', '=', 'image');
    }

    public function form() {

        return $this->belongsTo('CustomForm', 'form_id', 'id');

    }

}