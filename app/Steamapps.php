<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Steamapps extends Model
{
    protected $table = 'steamapps';
    protected $primaryKey = 'appid';
    public $timestamps = false;
}
