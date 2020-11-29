<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Queue;
use App\Models\Queues_users;
use App\Models\Schedule;
use App\Models\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class QueueController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

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

    //Люди в очереди
    public function people(Queue $queue)
    {
        $people = $queue->people;
        $statuses = Status::pluck('name', 'id')->toArray();
        return view('queues.people', compact('queue', 'people', 'statuses'));
    }

    public function change(Queues_users $item)
    {
        \request()->validate([
            'status_id'=>'required'
        ]);
        $item->status_id = \request('status_id');
        $item->save();
        \request()->session()->flash('success', 'Статус человека в очереди был изменен');
        return redirect()->back();
    }

    public function close(Queue $queue)
    {
        $queue->closed = 1;
        $queue->save();
        return redirect()->back();
    }

    public function open(Queue $queue)
    {
        $queue->closed = 0;
        $queue->save();
        return redirect()->back();
    }
}
