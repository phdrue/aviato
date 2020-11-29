<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $connection = 'mysql';
    protected $table = 'doctors';
    public $timestamps = false;
    protected $guarded = [];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function day_schedule($day)
    {
        return $this->hasOne(Schedule::class)->where('day_id', $day);
    }

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

}
