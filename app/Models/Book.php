<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'isbn',
        'description',
        'image',
        'file',
        'status',
        'publish_year',
        'pageNumber',
        'size',
        'publication_id',
        'category_id',
        'sub_category_id',
        'book_language_id',
        'book_auth_id',
        'country_id',
        'is_active',
        'is_premium',
        'is_trending'
        
    ];

    function category(){
        return $this->belongsTo(Category::class);
    }

    function bookAuth(){
        return $this->belongsTo(BookAuth::class);
    }

    function bookLanguage(){
        return $this->belongsTo(BookLanguage::class);
    }

    function publication(){
        return $this->belongsTo(publication::class);
    }

    function country(){
        return $this->belongsTo(Country::class);
    }
   
}
