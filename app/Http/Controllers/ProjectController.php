<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate();

        return view('project.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * $projects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        return view('project.create', compact('project'));
    }

    public function createUp(Request $request, Event $event)
    {
        // Obtener el usuario
        $user = User::find(auth()->user()->id);

        // Verificar si el usuario tiene el evento con el ID dado
        if ($user->registeredEvents()->where('events.id', $event->id)->exists()) {
            return redirect()->route('project-up-create', $event);
        }

        $password = $request->input('password');
        if ($password == null) {
            return view(
                'project.password',
                ['event' => $event]
            );
        } else {

            if ($password != $event->password) {
                return view(
                    'project.password',
                    [
                        'event' => $event,
                        'password' => 'La contraseña proporcionada no es válida.'
                    ]
                );
            }
            //SI LLEGA AQUI FUE PORQUE COLOCO LA CONTRASEÑA CORRECTAMENTE

            // Adjuntar el usuario al evento en la tabla pivot
            $event->registeredUsers()->attach(auth()->user()->id);

            return redirect()->route('project-up-create', $event);
        }
    }

    public function createUpProject(Request $request, Event $event)
    {
        // Obtener el usuario
        $user = User::find(auth()->user()->id);

        // Verificar si el usuario tiene el evento con el ID dado
        if (!$user->registeredEvents()->where('events.id', $event->id)->exists()) {
            return redirect()->route('events.showBySlug', $event->slug);
        }

        $project = new Project();
        return view('project.create', compact('project', 'event'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Project::$rules);

        $project = Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        request()->validate(Project::$rules);

        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $project = Project::find($id)->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
