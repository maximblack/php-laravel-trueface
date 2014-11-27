<?php

class CustomFile extends Eloquent {

    protected $table = 'files';

    protected $fillable = array(
        'folder_id',
        'name',
        'extension',
        'type'
    );

    public function scopeAuthor($query) {
        return $query->where('user_id', '=', Auth::user()->id);
    }

    public function scopeWhereId($query, $id) {
        return $query->where('id', '=', $id);
    }

    public function scopeImages($query) {
        return $query->where('type', 'like', 'image%');
    }

    public function folder() {
        return $this->belongsTo('folder');
    }

}