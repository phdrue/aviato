@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Очереди за {{$day}}</h4>
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
                            <td><a href="{{route('queues.people', ['queue'=>$item])}}" role="button" class="btn btn-success">Просмотр</a></td>
                        </tr>
                    @empty
                        <h4 class="text-center card-title">Нет данных</h4>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
