@extends('layouts.main')
@section('title', '$event->title')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{$event->image}}" class="img-fluid" alt="{{$event->title}}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{$event->title}}</h1>
                <p class="event-city"><i class="fas fa-map-marker-alt"></i>{{$event->city}}</p>
                <p class="participants"><i class="fas fa-users"></i>{{count($event->users)}} participantes</p>
                <p class="event-ower"><i class="fas fa-star"></i>organizador: {{$eventOwer['name']}}</p>
                @if(!$HasUserJoined)
                    <form action="/events/join/{{$event->id}}" method="POST">
                    @csrf
                        <a href="/events/join/{{$event->id}}" class="btn btn-primary" id="event-submit"
                            onclick="event.preventDefault(); this.closest('form').submit();">confirmar presença</a>
                    </form>
                @else
                    <p class="already-jonied-msg main-subtitle">voce ja esta participando desse evento</p>
                @endif
                <ul id="items-list">
                    @if($event->items == null)
                        <p class="main-subtitle">o evento nao possui estrutura extra</p>
                    @else
                    <h3>o evento conta com</h3>
                    @foreach($event->items as $event->item)
                        <li><p class="event-items">{{$event->item}}</p></li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-md-12" id="description-container">
                <h3>sobre o evento</h3>
                <p class="event-description">{{$event->description}}</p>
            </div>
        </div>
    </div>

@endsection