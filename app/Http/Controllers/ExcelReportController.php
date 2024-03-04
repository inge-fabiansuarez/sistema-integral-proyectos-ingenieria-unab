<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Exports\ProjectsExport;
use App\Models\Event;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReportController extends Controller
{

    public function evaluationByEvent(Event $event)
    {
        ProjectsExport::export();

        return response()->download(public_path('exports/projects.xlsx'));
    }
}
