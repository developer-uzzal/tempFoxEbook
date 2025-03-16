<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','is_active'];

    function books(){
        return $this->hasMany(Book::class);
    }
    
    public function book(){
        return $this->hasMany(Book::class);
    }
}
