<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuFooter extends Model
{
    protected $fillable = [
        'logo',
        'fav_icon',
        'short_des',
        'address',
        'phone',
        'email',
        'facebook',
        'twitter',
        'youtube',
        'year',
        'copy_right',
        
    ];
}
