<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $connection = 'mysql';
    protected $table = 'specialties';
    public $timestamps = false;
}
