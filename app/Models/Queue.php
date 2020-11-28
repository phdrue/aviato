<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $connection = 'mysql';
    protected $table = 'queues';
    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
