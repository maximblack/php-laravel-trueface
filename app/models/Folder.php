<?php

class Folder extends Eloquent {

    protected $fillable = array(
        'user_id',
    );

    public function scopeAuthor($query) {
        return $query->where('user_id', '=', Auth::user()->id);
    }

    public function scopeWhereId($query, $id) {
        return $query->where('id', '=', $id);
    }

    public function customForm() {
        return $this->belongsTo('CustomForm');
    }

    public function files() {
        return $this->hasMany('CustomFile', 'folder_id', 'id');
    }

    public function user() {
        return $this->belongsTo('user', 'user_id');
    }

}