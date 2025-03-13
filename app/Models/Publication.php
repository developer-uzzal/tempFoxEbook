<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class publication extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];
}
