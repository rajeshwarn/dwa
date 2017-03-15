<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
	protected $table = 'movie';
    protected $fillable = ['slug_id','title','rating','duration','year','category','description','release_date','country','actor','director','featured','featured_position','featured_image','quality','gdrive_link','photo_google_link','trailer_link'];

    
}
