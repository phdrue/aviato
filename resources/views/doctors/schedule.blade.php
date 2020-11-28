@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center card-title">Расписание {{$doctor->name}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>День недели</th>
                        <th>Основной прием</th>
                        <th>Дополнительный прием</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($days as $day)
                        @if($doctor->schedules()->where('day_id', $day->id)->first() != null)
                            <tr class="table-success">
                        @else
                            <tr class="table-danger">
                        @endif
                        <td>{{$day->name}}</td>
                        <td>{{$doctor->schedules()->where('day_id', $day->id)->first()->number ?? 'Нет'}}</td>
                        <td>{{$doctor->schedules()->where('day_id', $day->id)->first()->extra_number ?? 'Нет'}}</td>
                        <td>
                            @if ($doctor->schedules()->where('day_id', $day->id)->first() != null)
                            <form action="" method="POST">
                                @csrf
                                @method('DESTROY')
                                <button type="submit" class="btn btn-danger">Убрать прием в этот день</button>
                            </form>
                            @else
                            <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#model{{$day->engname}}">
                                    Назначить прием на этот день
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="model{{$day->engname}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Прием на {{$day->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('doctors.schedule.create', ['doctor'=>$doctor, 'day'=>$day])}}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="number">Основной прием</label>
                                                        <input type="text" name="number" id="number" class="form-control">
                                                        @error('number')
                                                        <small class="text-danger">Поле необходимо заполнить</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="extra_number">Дополнительный прием</label>
                                                        <input type="text" name="extra_number" id="extra_number" class="form-control">
                                                        @error('extra_number')
                                                        <small class="text-danger">Поле необходимо заполнить</small>
                                                        @enderror
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
                            @endif
                        </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
