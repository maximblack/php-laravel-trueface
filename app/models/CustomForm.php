<?php

class CustomForm extends Eloquent {

    protected $table = 'forms';

    protected $fillable = array(
        'user_id',
        'folder_id',
        'response_id',
        'name',
        'surname',
        'nickname',
        'occupation',
        'description',
        'finished'
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
        return $this->belongsTo('User', 'user_id', 'id');
    }

    public function files() {
        return $this->hasMany('FormsFiles', 'form_id', 'id');
    }

    public function responses() {
        return $this->hasMany('CustomResponse', 'form_id', 'id');
    }

}