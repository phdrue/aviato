@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center card-title">Создание доктора</h4>
            </div>
            <div class="card-body">
                <form action="{{route('doctors.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">ФИО</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                        @error('name')
                        <small class="text-danger">Поле обязательно для заполнения</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="specialty_id">Специальность</label>
                        {!! Form::select('specialty_id', $specialties , null ?? old('specialty_id'),
                            ['class' => 'form-control', 'placeholder'=>'Выберите...', 'id'=>'specialty_id']) !!}
                        @error('specialty_id')
                        <small class="text-danger">Поле обязательно для заполнения</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
            </div>
        </div>
    </div>
@endsection
