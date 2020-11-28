<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Queue;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class QueueController extends Controller
{
    //
    //Все очереди
    public function index()
    {
        $queues = Queue::all();
        return view('queues.index', compact('queues'));
    }

    //Очереди за определенный день
    public function explicit_day()
    {
        $queues = Queue::where('real_day', \request('day'))->get();
        $day = Carbon::parse(\request('day'))->format('d.m.Y');
        return view('queues.search', compact('queues', 'day'));
    }

    //Создание очереди
    public function create()
    {
        $doctors = Doctor::pluck('name', 'id')->toArray();
        return view('queues.create', compact('doctors'));
    }


    //Сохранение очереди
    public function store()
    {
//        \request()->validate([
//            'certificatetype_id'=>['required',
//                'numeric',
//                Rule::unique('certificates_students', 'certificatetype_id')->where(function ($query){
//                    return $query->where('student_id', \request('student_id'));
//                })]
//        ]);

        \request()->validate([
            'real_day'=>'required|date',
            'doctor_id'=>['required', 'numeric',
                Rule::unique('queues', 'doctor_id')->where(function ($query){
                    return $query->where('real_day', \request('real_day'));
                })]
        ]);

        $dayOfTheWeek = Carbon::parse(\request('real_day'))->dayOfWeek;
        $new_queue = [
            'doctor_id'=>\request('doctor_id'),
            'real_day'=>\request('real_day'),
            'day_id'=>$dayOfTheWeek
        ];
        Queue::create($new_queue);
        return redirect()->route('queues.index');
    }
}
