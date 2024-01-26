<?php

namespace App\Http\Controllers;

use App\Models\ProjectField;
use Illuminate\Http\Request;

/**
 * Class ProjectFieldController
 * @package App\Http\Controllers
 */
class ProjectFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectFields = ProjectField::orderBy('order')->paginate();

        return view('project-field.index', compact('projectFields'))
            ->with('i', (request()->input('page', 1) - 1) * $projectFields->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectField = new ProjectField();
        return view('project-field.create', compact('projectField'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProjectField::$rules);

        $projectField = ProjectField::create($request->all());

        return redirect()->route('project-fields.index')
            ->with('success', 'ProjectField created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectField = ProjectField::find($id);

        return view('project-field.show', compact('projectField'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectField = ProjectField::find($id);

        return view('project-field.edit', compact('projectField'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectField $projectField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectField $projectField)
    {
        request()->validate(ProjectField::$rules);

        $projectField->update($request->all());

        return redirect()->route('project-fields.index')
            ->with('success', 'ProjectField updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectField = ProjectField::find($id)->delete();

        return redirect()->route('project-fields.index')
            ->with('success', 'ProjectField deleted successfully');
    }
}
