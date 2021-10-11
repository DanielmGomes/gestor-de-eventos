@extends('layouts.main')
@section('title', 'dashboard')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>meus eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nome</th>
                        <th scope="col">participantes</th>
                        <th scope="col">acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td scropt="row">{{$loop->index+1}}</td>
                            <td><a href="/events/{{$event->id}}">{{$event->title}}</a></td>
                            <td>{{count($event->users)}}</td>
                            <td>
                                <a href="/events/edit/{{$event->id}}" class="btn btn-info edit-btn"><i class="fas fa-edit"></i></a>
                                <form action="/events/{{$event->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger delete-btn"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>voce ainda nao tem eventos<a href="/events/create">criar evento</a></p>
        @endif
    </div>

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>eventos que estou participando</h1>
    </div>
    <div class="col-md-10 offeset-md-1 dashboard-events-container">
        @if(count($eventsasparticipant) > 0):
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nome</th>
                        <th scope="col">participantes</th>
                        <th scope="col">acoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventsasparticipant as $event)
                        <tr>
                            <td scropt="row">{{$loop->index+1}}</td>
                            <td><a href="/events/{{$event->id}}">{{$event->title}}</a></td>
                            <td>{{count($event->users)}}</td>
                            <td>
                                <form action="/events/leave/{{$event->id}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon>sair do evento
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>voce ainda nao esta participando de nenhum evento, <a href="/">veja todos os eventos</a></p>
        @endif
    </div>

@endsection