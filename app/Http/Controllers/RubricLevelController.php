<?php

namespace App\Http\Controllers;

use App\Models\RubricCriterion;
use App\Models\RubricLevel;
use Illuminate\Http\Request;

/**
 * Class RubricLevelController
 * @package App\Http\Controllers
 */
class RubricLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubricLevels = RubricLevel::paginate();

        return view('rubric-level.index', compact('rubricLevels'))
            ->with('i', (request()->input('page', 1) - 1) * $rubricLevels->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RubricCriterion $criterion = null)
    {
        $rubricLevel = new RubricLevel();
        return view('rubric-level.create', compact('rubricLevel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(RubricLevel::$rules);

        $rubricLevel = RubricLevel::create($request->all());

        return redirect()->route('rubrics.show', $rubricLevel->rubricCriterion->rubric)
            ->with('success', 'RubricLevel created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rubricLevel = RubricLevel::find($id);

        return view('rubric-level.show', compact('rubricLevel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rubricLevel = RubricLevel::find($id);

        return view('rubric-level.edit', compact('rubricLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RubricLevel $rubricLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RubricLevel $rubricLevel)
    {
        request()->validate(RubricLevel::$rules);

        $rubricLevel->update($request->all());

        return redirect()->route('rubric-levels.index')
            ->with('success', 'RubricLevel updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rubricLevel = RubricLevel::find($id)->delete();

        return redirect()->route('rubric-levels.index')
            ->with('success', 'RubricLevel deleted successfully');
    }
}
