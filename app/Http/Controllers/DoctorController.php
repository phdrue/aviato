<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoctorController extends Controller
{
    //
    //Получить расписание доктора
    public function get_schedule(Doctor $doctor)
    {
        $days = Day::all();
        return view('doctors.schedule', compact('doctor', 'days'));
    }

    //Назначить расписание на конкретный день
    public function create_schedule(Doctor $doctor, Day $day)
    {
        \request()->validate([
            'number'=>'required|numeric',
            'extra_number'=>'required|numeric'
        ]);
        $new_schedule = [
            'doctor_id'=>$doctor->id,
            'day_id'=>$day->id,
            'number'=>\request('number'),
            'extra_number'=>\request('extra_number')
        ];
        Schedule::create($new_schedule);
        \request()->session()->flash('success', 'Изменения были успешно применены');
        return redirect()->back();
    }

    //Все доктора
    public function index()
    {
        $doctors = Doctor::paginate(15);
        return view('doctors.index', compact('doctors'));
    }

    //Создание
    public function create()
    {
        $specialties = Specialty::pluck('name', 'id')->toArray();
        return view('doctors.create', compact('specialties'));
    }

    //Сохранение
    public function store()
    {
        \request()->validate([
            'name'=>'required',
            'specialty_id'=>'required|exists:specialties,id'
        ]);

        $new_doctor = [
            'name'=>\request('name'),
            'specialty_id'=>\request('specialty_id')
        ];
        Doctor::create($new_doctor);
        \request()->session()->flash('success', 'Доктор был создан');
        return redirect()->route('doctors.index');
    }
}
