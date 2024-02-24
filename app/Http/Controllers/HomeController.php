<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Project;
use App\Models\Rubric;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }
    public function dashboard()
    {
        return view('dashboard', [
            'dataDashborad' => [
                'totalUsers' => User::count(),
                'totalProjects' => Project::count(),
                'totalEvents' => Event::count(),
                'totalRubrics' => Rubric::count(),
                'listProjects' => Project::orderBy('created_at', 'desc')->limit(10)->get()
            ]
        ]);
    }
}
