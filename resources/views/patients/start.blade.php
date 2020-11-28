@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center card-title">Запись на прием</h4>
            </div>
            <div class="card-body">
                <form action="{{route('patient.queues')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="day">День</label>
                        <input type="date" name="day" id="day"  class="form-control">
                        @error('day')
                        <small class="text-danger">Поле необходимо заполнить</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Найти приемы</button>
                </form>
            </div>
        </div>
    </div>
@endsection
