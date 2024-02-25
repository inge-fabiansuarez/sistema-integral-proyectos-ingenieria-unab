<?php

namespace App\Http\Controllers;

use App\Enums\TypeFieldProjectEnum;
use App\Models\Event;
use App\Models\Keyword;
use App\Models\Project;
use App\Models\ProjectAuthor;
use App\Models\ProjectField;
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
    public function create(Request $request, Event $event)
    {
        // Obtener el usuario
        $user = User::find(auth()->user()->id);
        $keywords = Keyword::all();

        // Verificar si el usuario tiene el evento con el ID dado
        if (!$user->registeredEvents()->where('events.id', $event->id)->exists()) {
            return redirect()->route('events.showBySlug', $event->slug);
        }

        $project = new Project();
        $authors =  User::orderBy('name', 'asc')->get();
        return view('project.create', compact('project', 'event', 'authors', 'keywords'));
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




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->get('keywords'));
        $idEvent = $request->input('event');
        $event = Event::find($idEvent);
        //dd($event);
        $validations = Project::$rules;
        foreach ($event->projectFields as $field) {
            switch ($field->type_field) {
                case TypeFieldProjectEnum::TEXT->getId():
                    $validations[$field->slug] = 'required|string';
                    break;
                case TypeFieldProjectEnum::FILE->getId():
                    $validations[$field->slug] = 'required|file';
                    break;
            }
        }
        $validations['authors'] = 'required|array|min:1';
        request()->validate($validations);

        $project = new Project([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        // Maneja la imagen de portada
        $coverImage = $request->file('cover_image');

        // Verifica si se ha subido una imagen de portada
        if ($coverImage) {
            // Genera un nombre único para la imagen de portada
            $coverImageName = uniqid() . '_' . $coverImage->getClientOriginalName();

            // Almacena la imagen de portada en el sistema de archivos
            $coverImage->storeAs('projects/cover_images', $coverImageName, 'public');

            // Guarda la ruta de la imagen de portada en la base de datos
            $project->cover_image = 'projects/cover_images/' . $coverImageName;
        }


        // Guarda el proyecto en la base de datos
        $project->save();
        //dd($project);

        // Asocia el proyecto con el evento
        $project->events()->attach($event);


        // Guarda los campos específicos para cada tipo de proyecto
        foreach ($event->projectFields as $field) {
            $fieldName = $field->slug;
            $fieldType = TypeFieldProjectEnum::from($field->type_field);


            switch ($fieldType) {
                case TypeFieldProjectEnum::TEXT:
                    $value = $request->input($fieldName);
                    break;
                case TypeFieldProjectEnum::FILE:
                    $file = $request->file($fieldName);

                    // Verifica si se ha subido un archivo
                    if ($file) {
                        // Genera un nombre único para el archivo
                        $fileName = uniqid() . '_' . $file->getClientOriginalName();

                        // Almacena el archivo en el sistema de archivos
                        $file->storeAs('projects/archivos_proyectos', $fileName, 'public');

                        // Guarda la ruta del archivo en la base de datos
                        $value = 'projects/archivos_proyectos/' . $fileName;
                    } else {
                        $value = null;
                    }
                    break;
            }

            // Guarda el campo en la tabla pivot
            $project->projectFields()->attach($field->id, ['value' => $value]);
        }


        $arrayAuthors = $request->input('authors');
        if ($arrayAuthors != null) {
            // Asociar los autores seleccionados con el proyecto
            foreach ($arrayAuthors as $authorId) {
                echo $authorId;
                ProjectAuthor::create([
                    'projects_id' => $project->id,
                    'users_id' => $authorId
                ]);
            }
        }

        $keywords = $request->input('keywords');

        foreach ($keywords as $keyword) {
            $existingKeyword = Keyword::where('name', $keyword)->first();

            if (!$existingKeyword) {
                // La palabra clave no existe, así que la creamos
                $newKeyword = Keyword::create(['name' => $keyword]);

                // Ahora relacionamos la nueva palabra clave con el proyecto
                $project->keywords()->attach($newKeyword->id);
            } else {
                // La palabra clave ya existe, solo la relacionamos con el proyecto
                $project->keywords()->attach($existingKeyword->id);
            }
        }


        return redirect()->route('projects.index')
            ->with('success', 'Proyecto creado correctamente.');
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
