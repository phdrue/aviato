<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Queues_users extends Model
{
    protected $connection = 'mysql';
    protected $table = 'queues_users';
    protected $guarded = [];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
