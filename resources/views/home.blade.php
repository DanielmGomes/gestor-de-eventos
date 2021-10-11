@extends('layouts.main')
@section('title', 'Gestor de Eventos')

@section('content')

    <div id="search-container" class="col-md-12">
        <h1 class="main-title">busque um evento</h1>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="procurar...">
            <button type="submit" id="search-btn"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div id="events-container" class="col-md-12">
        @if($search)
            <h2>buscando por: {{$search}}</h2>
        @else
            <h2 class="main-subtitle">proximos eventos</h2>
        @endif
        <p class="subtitle">veja os eventos dos proximos dias</p>
        <div id="cards-container" class="row">
                @foreach($events as $event)
                    <div class="card col-md-3">
                        <img src="/img/events/{{$event->image}}" alt="{{$event->title}}">
                        <div class="card-body">
                            <p class="card-date">{{date('d/m/Y', strtotime($event->date))}}</p>
                            <h5 class="card-title">{{$event->title}}</h5>
                            <p class="card-participants">{{count($event->users)}} participantes</p>
                            <a href="/events/{{$event->id}}" class="btn btn-primary">saiba mais</a>
                        </div>
                    </div>
                @endforeach
                @if(count($events) == 0 && $search)
                    <p>nao foi possivel encontrar nenhum evento com o nome: {{$search}} <a href="/">ver todos os eventos disponiveis</a></p>
                @elseif(count($events) == 0)
                    <p>nao ha eventos disponiveis</p>
                @endif                

        </div>

    </div>

@endsection