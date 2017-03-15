<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestMov extends Model
{
    //
    protected $table = 'request';
    protected $fillable = [ 'value','status' ];
}
