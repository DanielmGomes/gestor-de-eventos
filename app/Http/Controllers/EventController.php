<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
 
/* --- direcionamento para pagina home --- */
    public function index(){
        
        $search = request('search');

        if ($search) {
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        }else {
            $events = Event::all();
        }

        return view('home', ['events' => $events, 'search' => $search]);
    }

/* --- abrir pagina de criacao de eventos --- */
    public function create(){
        return view('events.create');
    }

/* --- salvar eventos --- */
    public function store(Request $request){
        
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->state = $request->state;
        $event->items = $request->items;

        //image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now'))  . '.' . $extension;
            
            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'evento criado com sucesso.');

    }

/* --- exibir eventos --- */
    public function show($id){
        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if ($user) {
            
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent) {
                if ($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }

        }

        $eventOwer = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwer' => $eventOwer, 'HasUserJoined' => $hasUserJoined]);
    }

/* --- exibir area autenticada --- */
    public function dashboard (){
        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]);

    }

/* ---- deletar evento --- */
    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'evento excluido com sucesso');
    }


/* --- abrir pagina de edicao de evento --- */
    public function edit($id){

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if ($user->id != $event->user->id) {
            return redirect('dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

/* --- editar evento --- */
    public function update(Request $request){

        $data = $request->all();

        //image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now'))  . '.' . $extension;
            
            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'evento editado com sucesso');

    }

/* ---- inscrever no evento --- */
    public function joinEvent($id){

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'presença confirmada no evento: ' . $event->title);
    }

/* --- desinscrever do evento --- */
    public function leaveEvent($id){

        $user = auth()->user(); 
        
        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'voce saiu do evento: ' . $event->title);


    }

}
