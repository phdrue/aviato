<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $connection = 'mysql';
    protected $table = 'statuses';
}
