@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('queues.create')}}" role="button" class="btn btn-primary btn-lg mb-3">Новая очередь</a>
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{route('queues.explicit.day')}}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="day">Выбор определенного дня</label>
                        <input type="date" class="form-control" name="day" id="day">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Найти</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Все очереди</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>День</th>
                        <th>Доктор</th>
                        <th>Просмотр очереди</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($queues as $item)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($item->real_day)->format('d.m.Y') }}</td>
                            <td>{{$item->doctor->name}}</td>
                            <td></td>
                        </tr>
                    @empty
                        <h4 class="text-center card-title">Пока нет данных</h4>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
