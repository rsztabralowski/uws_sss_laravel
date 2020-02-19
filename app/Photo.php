<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    $fillable = ['user_id', 'path', 'description'];
}
