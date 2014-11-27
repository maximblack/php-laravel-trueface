<?php

class CustomResponse extends Eloquent {

    protected $table = 'responses';

    protected $fillable = array(
        'form_id',
        'user_id',
        'user_id_foreign'
    );

    public function scopeAuthor($query) {
        return $query->where('user_id', '=', Auth::user()->id);
    }

    public function scopeWhereId($query, $id) {
        return $query->where('id', '=', $id);
    }

    public function scopeFinished($query, $finished = true) {
        return $query->where('finished', '=', $finished);
    }

    public function user() {
        return $this->belongsTo('User', 'user_id');
    }

    public function user_foreign() {
        return $this->belongsTo('User', 'user_id_foreign');
    }

    public function folder() {
        return $this->hasOne('Folder', 'id', 'folder_id');
    }

    public function form() {
        return $this->hasOne('CustomForm', 'id', 'form_id');
    }

}