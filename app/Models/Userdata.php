<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Userdata extends Model
{
    protected $connection = 'mysql';
    protected $table = 'userdata';
    protected $guarded = [];
    public $timestamps = false;


}
