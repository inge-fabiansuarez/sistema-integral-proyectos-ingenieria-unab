<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\ProjectField;
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
        // return view('event.create', compact('event'));
        $projectFields = ProjectField::pluck('name', 'id'); // Puedes ajustar la consulta según tus necesidades
        $selectedProjectFields = $event->projectFields->pluck('id')->toArray(); // Puedes ajustar la obtención de los campos de proyecto seleccionados

        return view('event.create', compact('event', 'projectFields', 'selectedProjectFields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Event::$rules);

        // Crear el evento
        $event = new Event($request->all());
        $event->created_by = auth()->user()->id;

        // Generar y asignar el slug a partir del título
        $event->slug = Str::slug($request->input('title'));

        // Manejar la carga de la imagen
        if ($request->hasFile('img_cover')) {
            $imagePath = $request->file('img_cover')->store('event_images', 'public');
            $event->img_cover = $imagePath;

            // Guardar el evento
            $event->save();

            // Guardar los campos de proyecto seleccionados en la tabla pivot
            if ($request->has('project_fields') && is_array($request->input('project_fields'))) {
                $event->projectFields()->sync($request->input('project_fields'));
            }

            return redirect()->route('events.index')->with('success', 'Evento creado exitosamente.');
        } else {
            return back()->with('error', 'Ocurrió un error en la carga de la imagen.');
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
        $projectFields = ProjectField::pluck('name', 'id'); // Obtener solo los nombres y usar los ID como claves
        $selectedProjectFields = $event->projectFields->pluck('id')->toArray();

        return view('event.edit', compact('event', 'projectFields', 'selectedProjectFields'));
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

        // Guardar la ruta de la imagen actual
        $oldImagePath = $event->img_cover;
        // Actualiza los campos básicos del evento
        $event->update($request->except('img_cover'));

        // Actualiza la imagen si se proporciona
        if ($request->hasFile('img_cover')) {
            $imagePath = $request->file('img_cover')->store('event_images', 'public');
            $event->img_cover = $imagePath;
            $event->save();

            // Eliminar la imagen anterior
            if ($oldImagePath && file_exists(public_path("storage/$oldImagePath"))) {
                unlink(public_path("storage/$oldImagePath"));
            }
        }

        // Sincroniza los campos de proyecto
        $event->projectFields()->sync($request->input('project_fields', []));

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
        $event = Event::find($id);

        // Guardar la ruta de la imagen antes de eliminar el evento
        $imagePath = $event->img_cover;
        // Eliminar el evento
        $event->delete();

        // Eliminar la imagen asociada si existe
        if ($imagePath && file_exists(public_path("storage/$imagePath"))) {
            unlink(public_path("storage/$imagePath"));
        }

        return redirect()->route('events.index')
            ->with('success', 'Evento eliminado correctamente');
    }
}
