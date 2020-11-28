<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $connection = 'mysql';
    protected $table = 'schedules';
    protected $guarded = [];
    public $timestamps = false;


}
