<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $table = 'client_sync';
    protected $fillable = ['id','client','time_sync','categori'];   
}
