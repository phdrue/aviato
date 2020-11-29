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
                        <th>Специальность</th>
                        <th>Дополнительные сведения</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($queues as $item)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($item->real_day)->format('d.m.Y') }}</td>
                            <td>{{$item->doctor->name}}</td>
                            <td>{{$item->doctor->specialty->name}}</td>
                            <td>
                                @foreach($days as $day)
                                    @if (\App\Models\Schedule::where('doctor_id', $item->doctor->id)->where('day_id', $day->id)->first() != null)
                                        <span class="days day-green">{{substr($day->name, 0, 2)}}</span>
                                    @else
                                        <span class="days day-red">{{substr($day->name, 0, 2)}}</span>
                                    @endif
                                    @endforeach
                            </td>
                            <td>
                                @if (count($item->people) < \App\Models\Schedule::where('doctor_id', $item->doctor_id)->where('day_id',$item->day_id)->first()->number + \App\Models\Schedule::where('doctor_id', $item->doctor_id)->where('day_id',
$item->day_id)->first()->extra_number && $item->closed == 0)

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#model{{$item->id}}">
                                    Записаться
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="model{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Прием к {{$item->doctor->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{QrCode::size(250)->generate("http://10.0.2.2:8000/api/toqueue/" . $item->id)}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @else
                                    На этот день нет свободных мест
                                    @endif
                            </td>
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
