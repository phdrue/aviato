@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($queue->closed == 0)
            <a href="{{route('queue.close', ['queue'=>$queue])}}" role="button" class="btn bg-danger btn-lg mb-3">Закрыть запись</a>
        @else
            <a href="{{route('queue.open', ['queue'=>$queue])}}" role="button" class="btn bg-success btn-lg mb-3">Открыть запись</a>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Очередь к {{$queue->doctor->name}} {{\Carbon\Carbon::parse($queue->real_day)->format('d.m.Y')}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($people as $item)
                    <tr>
                        <td>{{$item->user->userdata->first_name}} {{$item->user->userdata->second_name}} {{$item->user->userdata->last_name}}</td>
                        <td>{{$item->status->name}}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#model{{$item->id}}">
                                Изменить статус
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="model{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Очередь к {{$queue->doctor->name}} {{\Carbon\Carbon::parse($queue->real_day)->format('d.m.Y')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('queues.change', ['item'=>$item])}}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="status_id">Новый статус</label>
                                                    {!! Form::select('status_id', $statuses , null , ['class' => 'form-control', 'placeholder'=>'Выберите...']) !!}
                                                </div>
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <h4 class="text-center card-title">Пока что никто не записан</h4>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
