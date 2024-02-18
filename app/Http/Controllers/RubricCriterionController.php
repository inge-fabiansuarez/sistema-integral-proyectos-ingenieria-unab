<?php

namespace App\Http\Controllers;

use App\Models\Rubric;
use App\Models\RubricCriterion;
use Illuminate\Http\Request;

/**
 * Class RubricCriterionController
 * @package App\Http\Controllers
 */
class RubricCriterionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubricCriteria = RubricCriterion::paginate();

        return view('rubric-criterion.index', compact('rubricCriteria'))
            ->with('i', (request()->input('page', 1) - 1) * $rubricCriteria->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Rubric $rubric = null)
    {
        $rubricCriterion = new RubricCriterion();
        $rubricCriterion->rubrics_id = $rubric->id;
        return view('rubric-criterion.create', compact('rubricCriterion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(RubricCriterion::$rules);

        $rubricCriterion = RubricCriterion::create($request->all());

        return redirect()->route('rubrics.show', $rubricCriterion->rubric)
            ->with('success', 'El criterio de la rubrica fue creado exitorsamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rubricCriterion = RubricCriterion::find($id);

        return view('rubric-criterion.show', compact('rubricCriterion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rubricCriterion = RubricCriterion::find($id);

        return view('rubric-criterion.edit', compact('rubricCriterion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RubricCriterion $rubricCriterion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RubricCriterion $rubricCriterion)
    {
        request()->validate(RubricCriterion::$rules);

        $rubricCriterion->update($request->all());

        return redirect()->route('rubric-criteria.index')
            ->with('success', 'RubricCriterion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rubricCriterion = RubricCriterion::find($id);
        $rubric = $rubricCriterion->rubric;
        $rubricCriterion->delete();
        return redirect()->route('rubrics.show', $rubric)
            ->with('success', 'Se elimino el criterio con exito');
    }
}
