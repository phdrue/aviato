@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Создание очереди</h4>
            </div>
            <div class="card-body">
                <form action="{{route('queues.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="doctor_id">Доктор</label>
                        {!! Form::select('doctor_id', $doctors , null ?? old('doctor_id') , ['class' => 'form-control', 'placeholder'=>'Выберите...', ]) !!}
                        @error('doctor_id')
                        <small class="text-danger">Поле необходимо заполнить</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="real_day">День</label>
                        <input type="date" class="form-control" name="real_day" id="real_day">
                        @error('real_day')
                        <small class="text-danger">Поле необходимо заполнить</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
            </div>
        </div>
    </div>
@endsection
