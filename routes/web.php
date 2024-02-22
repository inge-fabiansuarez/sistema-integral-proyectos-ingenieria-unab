<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectFieldController;
use App\Http\Controllers\Users\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\RubricController;
use App\Http\Controllers\RubricCriterionController;
use App\Http\Controllers\RubricEvaluationController;
use App\Http\Controllers\RubricLevelController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\Users\RoleController;
use App\Models\ProjectField;
use App\Models\RubricCriterion;
use App\Models\RubricEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('event/{slug}', [EventController::class, 'showBySlug'])->name('events.showBySlug');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('billing', function () {
        return view('billing');
    })->name('billing');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');



    Route::get('tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');

    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);

    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');

    //USUARIOS
    Route::group(['middleware' => ['can:users']], function () {
        Route::get('users/create', [RegisterController::class, 'create'])->name('user.create');
        Route::post('users/create', [RegisterController::class, 'store'])->name('user.store');
        Route::get('users', function () {
            return view('laravel-examples/user-management');
        })->name('user.index');
        Route::get('users/create', [RegisterController::class, 'create'])->name('user.create');
        Route::get('users/{user}/edit', [RegisterController::class, 'edit'])->name('user.edit');
        Route::post('users/{user}/edit', [RegisterController::class, 'update'])->name('user.update');
        Route::delete('users/{user}', [RegisterController::class, 'destroy'])->name('user.destroy');
    });

    Route::group(['middleware' => ['can:event']], function () {
        Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    });


    //ROLES
    Route::resource('roles', RoleController::class)->names('user.roles');
    Route::get('/user-profile', [InfoUserController::class, 'create'])->name('userprofil.index');
    Route::post('/user-profile', [InfoUserController::class, 'store'])->name('userprofil.store');

    //events
    Route::resource('events', EventController::class)->middleware('can:event');
    Route::get('events/{event}/evaluacion', [EventController::class, 'indexEvaluation'])->name('events.indexevaluation');
    Route::post('events/{event}/evaluacion/asignar-rubrica', [EventController::class, 'assingRubric'])->name('events.assingRubric');
    Route::post('events/{project}/evaluacion', [EventController::class, 'setUserEvaluation'])->name('events.setUserEvaluation');

    //Evaluations
    Route::resource('mis-evaluaciones', RubricEvaluationController::class)->names('rubric-evaluations')->only(['index']);
    //Evaluations
    Route::get('mis-evaluaciones/{projectsHasEvaluator}', [RubricEvaluationController::class, 'create'])->name('rubric-evaluations.create');
    Route::post('mis-evaluaciones/{projectsHasEvaluator}', [RubricEvaluationController::class, 'store'])->name('rubric-evaluations.store');

    //campos del projecto
    Route::resource('project-fields', ProjectFieldController::class)->names('project-fields')->middleware('can:projectFields');

    //Projects
    Route::resource('projects', ProjectController::class)->names('projects')->middleware('can:projects');

    //DE PUEBA
    Route::post('projects-up/{event}', [ProjectController::class, 'createUp'])->name('up-project');
    Route::get('projects-up/{event}', [ProjectController::class, 'create'])->name('project-up-create');
    Route::post('projects-up/{event}/store', [ProjectController::class, 'store'])->name('project-up-create.store');

    //rubricas
    Route::resource('rubricas', RubricController::class)->names('rubrics');


    //rubricas
    Route::resource('criterios-de-rubrica', RubricCriterionController::class)->names('rubric-criteria');
    Route::get('criterios-de-rubrica/create/{rubric?}', [RubricCriterionController::class, 'create'])->name('rubric-criteria.create');


    //niveles de los criterios
    Route::resource('niveles-del-criterio', RubricLevelController::class)->names('rubric-levels');
    Route::get('niveles-del-criterio/create/{criterion?}', [RubricLevelController::class, 'create'])->name('rubric-levels.create');
});




Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
