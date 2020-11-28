<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Для администратора
Route::prefix('admin')->group(function (){
    //Для докторов
    Route::prefix('doctors')->group(function (){
        //Справочник докторов
        Route::get('', [DoctorController::class, 'index'])->name('doctors.index');
        //Форма создания доктора
        Route::get('create', [DoctorController::class, 'create'])->name('doctors.create');
        //Сохранение доктора
        Route::post('store', [DoctorController::class, 'store'])->name('doctors.store');
        //Форма изменения доктора
        Route::any('edit/{doctor}', [DoctorController::class, 'edit'])->name('doctors.edit');
        //Обновление доктора
        Route::put('update/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
        //Получить расписание доктора
        Route::any('schedule/{doctor}', [DoctorController::class, 'get_schedule'])->name('doctors.schedule');
        //создать расписание
        Route::post('schedule/create/{doctor}/{day}', [DoctorController::class, 'create_schedule'])->name('doctors.schedule.create');
    });

    //Для очередей
    Route::prefix('queues')->group(function (){
        //Все очереди
        Route::get('', [QueueController::class, 'index'])->name('queues.index');
        //Очереди на конкретный день
        Route::any('day', [QueueController::class, 'explicit_day'])->name('queues.explicit.day');
        //Создание очереди
        Route::get('create', [QueueController::class, 'create'])->name('queues.create');
        //Сохранение очереди
        Route::post('store', [QueueController::class, 'store'])->name('queues.store');
        //Люди в определенной очереди
        Route::get('people/{queue}', [QueueController::class, 'people'])->name('queues.people');
        //Изменить статус человека в очереди
        Route::post('change/{item}', [QueueController::class, 'change'])->name('queues.change');
        //Закрыть запись
        Route::get('close/{queue}', [QueueController::class, 'close'])->name('queue.close');
        //Открыть запись, если она была закрыта
        Route::get('open/{queue}', [QueueController::class, 'open'])->name('queue.open');
    });
});


//Для пользователя
Route::get('start', [PatientController::class, 'start'])->name('patient.start');
//Получить все доступные очереди на выбранный день
Route::post('day', [PatientController::class, 'queues_day'])->name('patient.queues');

