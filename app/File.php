<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['title', 'description', 'author_id', 'file_type', 'filesize', 'path', 'file_status', 'enc_status', 'enc_pass', 'vector', 'org_name'];

    public function User()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
}
