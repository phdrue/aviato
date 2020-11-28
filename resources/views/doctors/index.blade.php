@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('doctors.create')}}" role="button" class="btn btn-primary btn-lg mb-3">Новый</a>
        <div class="card">
            <div class="card-header">
                <h4 class="text-center card-title">Доктора</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Ф.И.О</th>
                            <th>Специальность</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td>{{$doctor->id}}</td>
                            <td>{{$doctor->name}}</td>
                            <td>{{$doctor->specialty->name}}</td>
                            <td>
                                <a href="{{route('doctors.schedule', ['doctor'=>$doctor])}}" role="button" class="btn btn-warning">Расписание</a>

                            </td>
                        </tr>
                    @empty
                        <h4 class="text-center card-title">Пока нет данных</h4>
                    @endforelse
                    </tbody>
                </table>
                {{$doctors->links()}}
            </div>
        </div>
    </div>
@endsection
