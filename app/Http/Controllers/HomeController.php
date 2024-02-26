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


        // Otras consultas...

        $keywordFrequency = Project::join('keyword_project', 'projects.id', '=', 'keyword_project.project_id')
            ->join('keywords', 'keyword_project.keyword_id', '=', 'keywords.id')
            ->selectRaw('keywords.name, COUNT(*) as frequency')
            ->whereBetween('projects.created_at', [Carbon::now()->subMonths(6), Carbon::now()])
            ->groupBy('keywords.name')
            ->orderByDesc('frequency')
            ->take(10)
            ->get();

        $labels = $keywordFrequency->pluck('name');
        $data = $keywordFrequency->pluck('frequency');


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
                'percentageActiveUsers' => $percentageActiveUsers,
                'activeUsersByMonth' => User::selectRaw('EXTRACT(YEAR FROM last_login_at) as year, EXTRACT(MONTH FROM last_login_at) as month, COUNT(*) as count')
                    ->whereNotNull('last_login_at')
                    ->groupBy('year', 'month')
                    ->orderBy('year')
                    ->orderBy('month')
                    ->get(),
                'registeredUsersByMonth' => User::selectRaw('EXTRACT(YEAR FROM created_at) as year, EXTRACT(MONTH FROM created_at) as month, COUNT(*) as count')
                    ->groupBy('year', 'month')
                    ->orderBy('year')
                    ->orderBy('month')
                    ->get(),
                'months' => collect(range(1, 12))->map(function ($month) {
                    return Carbon::create(null, $month, 1)->format('M'); // Formato abreviado de mes (por ejemplo, "Jan", "Feb", etc.)
                }),

            ],
            'keywordChartData' => [
                'labels' => $labels,
                'data' => $data,
            ]
        ]);
    }
}
