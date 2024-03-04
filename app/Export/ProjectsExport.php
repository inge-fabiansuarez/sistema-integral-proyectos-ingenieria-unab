<?php

namespace App\Exports;

use App\Models\Project;
use PHPExcel;
use PHPExcel_IOFactory;

class ProjectsExport
{
    public static function export()
    {
        $projects = Project::all();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        // Agregar encabezados de columna
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Description');

        // Agregar datos de proyectos
        $row = 2;
        foreach ($projects as $project) {
            $sheet->setCellValue('A'.$row, $project->id);
            $sheet->setCellValue('B'.$row, $project->title);
            $sheet->setCellValue('C'.$row, $project->description);
            $row++;
        }

        // Crear archivo Excel
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(public_path('exports/projects.xlsx'));
    }
}
