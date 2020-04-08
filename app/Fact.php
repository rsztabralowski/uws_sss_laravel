<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    protected $fillable = ['user_id', 'photo_path', 'description'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
}
