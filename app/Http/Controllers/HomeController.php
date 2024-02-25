<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Project;
use App\Models\Rubric;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }
    public function dashboard()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDays(90))->count();

        // Verificar si el total de usuarios es mayor que cero antes de calcular el porcentaje
        $percentageActiveUsers = ($totalUsers > 0) ? ($activeUsers / $totalUsers) * 100 : 0;

        return view('dashboard', [
            'dataDashborad' => [
                'totalUsers' => $totalUsers,
                'totalProjects' => Project::count(),
                'totalEvents' => Event::count(),
                'totalRubrics' => Rubric::count(),
                'listProjects' => Project::orderBy('created_at', 'desc')->limit(10)->get(),
                'projectsByDay' => Project::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(),  Carbon::now()->endOfMonth()])
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get(),
                'usersByDay' => User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get(),
                'projectsLastMonth' => Project::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->endOfMonth()])
                    ->count(),
                'activeUsers' => $activeUsers,
                'percentageActiveUsers' => $percentageActiveUsers
            ]
        ]);
    }
}
