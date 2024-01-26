<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate();

        return view('event.index', compact('events'))
            ->with('i', (request()->input('page', 1) - 1) * $events->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();
        return view('event.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Event::$rules);
        $event = new Event($request->all());
        $event->created_by = auth()->user()->id;
        // Generar y asignar el slug a partir del título
        $event->slug = Str::slug($request->input('title'));

        // Manejar la carga de la imagen
        if ($request->hasFile('img_cover')) {
            $imagePath = $request->file('img_cover')->store('event_images', 'public');
            $event->img_cover = $imagePath;
            $event->save();
            return redirect()->route('events.index')
                ->with('success', 'Evento creado exitosamente.');
        } else {
            echo "OCURRIO UN ERROR CARGA DE IMAGEN";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        return view('event.show', compact('event'));
    }

    public function showBySlug($slug)
    {
        $event = Event::where('slug', $slug)->first();
        if ($event  != null) {
            return view('event.show', ['event' => $event]);
        } else {
            echo "NO SE ENCONTRO EL EVENTO";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);

        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        request()->validate(Event::$rules);

        $event->update($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Evento actualizado correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $event = Event::find($id)->delete();

        return redirect()->route('events.index')
            ->with('success', 'Evento eliminado correctamente');
    }
}
