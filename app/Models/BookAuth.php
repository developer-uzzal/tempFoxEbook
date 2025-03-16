<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookAuth extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',

    ];

    public function book(){
        return $this->hasMany(Book::class);
    }

}
