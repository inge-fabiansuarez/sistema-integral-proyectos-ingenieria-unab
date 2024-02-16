<?php

namespace App\Http\Controllers;

use App\Models\Rubric;
use Illuminate\Http\Request;

/**
 * Class RubricController
 * @package App\Http\Controllers
 */
class RubricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubrics = Rubric::paginate();

        return view('rubric.index', compact('rubrics'))
            ->with('i', (request()->input('page', 1) - 1) * $rubrics->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubric = new Rubric();
        return view('rubric.create', compact('rubric'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Rubric::$rules);

        $rubric = Rubric::create($request->all());

        return redirect()->route('rubrics.index')
            ->with('success', 'Rubric created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rubric = Rubric::find($id);

        return view('rubric.show', compact('rubric'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rubric = Rubric::find($id);

        return view('rubric.edit', compact('rubric'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Rubric $rubric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubric $rubric)
    {
        request()->validate(Rubric::$rules);

        $rubric->update($request->all());

        return redirect()->route('rubrics.index')
            ->with('success', 'Rubric updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rubric = Rubric::find($id)->delete();

        return redirect()->route('rubrics.index')
            ->with('success', 'Rubric deleted successfully');
    }
}
