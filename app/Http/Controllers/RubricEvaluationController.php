<?php

namespace App\Http\Controllers;

use App\Enums\StateEvaluationUserEnum;
use App\Models\Event;
use App\Models\Project;
use App\Models\ProjectsHasEvaluators;
use App\Models\RubricEvaluation;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class RubricEvaluationController
 * @package App\Http\Controllers
 */
class RubricEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $evaluations = ProjectsHasEvaluators::where('evaluator_id', $user->id)->where('state_evaluation', StateEvaluationUserEnum::ASSIGNED->getId())->get();


        return view('rubric-evaluation.index', ['evaluations' => $evaluations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProjectsHasEvaluators $projectsHasEvaluator)
    {
        $project = $projectsHasEvaluator->project;
        $rubric = $projectsHasEvaluator->event->rubric;
        $event = $projectsHasEvaluator->event;
        $rubricEvaluations = null;
        if (StateEvaluationUserEnum::EVALUATED->getId() == $projectsHasEvaluator->state_evaluation) {
            $rubricEvaluations = RubricEvaluation::where('projects_id', $project->id)->where('evaluador_id', auth()->user()->id)->get();
        }
        return view('rubric-evaluation.create', compact('projectsHasEvaluator', 'project', 'rubric', 'event', 'rubricEvaluations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProjectsHasEvaluators $projectsHasEvaluator)
    {

        $evaluations = RubricEvaluation::where('projects_id', $projectsHasEvaluator->project->id)->where('evaluador_id', auth()->user()->id)->get();
        //validar que no se hubiera hecho alguna evaluacion con el usuario previamente, cosa que no deberia pasar. pero por si las moscas XD XD XD
        if ($evaluations->count() == 0) {
            $rubric = $projectsHasEvaluator->event->rubric;
            // Validate request data
            $rules = [];
            foreach ($rubric->rubricCriterias as $criteria) {
                $rules['criteria_' . $criteria->id] = 'required|exists:rubric_levels,id';
            }

            $request->validate($rules);
            foreach ($rubric->rubricCriterias as $criteria) {
                RubricEvaluation::create([
                    'projects_id' => $projectsHasEvaluator->project->id,
                    'evaluador_id' => auth()->user()->id,
                    'rubric_criteria_id' => $criteria->id,
                    'rubric_levels_selected_id' => $request->get('criteria_' . $criteria->id),
                    'comments' => ''
                ]);
            }

            $projectsHasEvaluator->state_evaluation = StateEvaluationUserEnum::EVALUATED->getId();
            $projectsHasEvaluator->save();
        }

        return redirect()->route('rubric-evaluations.show', auth()->user()->id, $projectsHasEvaluator->project)
            ->with('success', 'RubricEvaluation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $evaluator, Project $project)
    {
        $rubricEvaluations = RubricEvaluation::where('projects_id', $project->id)->where('evaluador_id', $evaluator->id)->get();
        return view('rubric-evaluation.show', compact('rubricEvaluations', 'project'));
    }

    public function showByProject(Project $project)
    {
        $projectHasEvaluator = ProjectsHasEvaluators::where('projects_id', $project->id)->paginate(10);
        return view('rubric-evaluation.show_evaluations', compact('project', 'projectHasEvaluator'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /* public function edit($id)
    {
        $rubricEvaluation = RubricEvaluation::find($id);

        return view('rubric-evaluation.edit', compact('rubricEvaluation'));
    } */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RubricEvaluation $rubricEvaluation
     * @return \Illuminate\Http\Response
     */
    /* public function update(Request $request, RubricEvaluation $rubricEvaluation)
    {
        request()->validate(RubricEvaluation::$rules);

        $rubricEvaluation->update($request->all());

        return redirect()->route('rubric-evaluations.index')
            ->with('success', 'RubricEvaluation updated successfully');
    } */

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    /*  public function destroy($id)
    {
        $rubricEvaluation = RubricEvaluation::find($id)->delete();

        return redirect()->route('rubric-evaluations.index')
            ->with('success', 'RubricEvaluation deleted successfully');
    } */
}
