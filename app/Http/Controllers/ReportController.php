<?php

namespace App\Http\Controllers;

use App\Report;

class ReportController extends Controller
{
    public function show($reportId)
    {
        $report = Report::findOrFail($reportId);

        $this->authorize('canSee', $report);


        return view('pages.report.report', ['report' => $report, 'breadcrumbs' => ['Report details' =>
            route('showReport', ['id' => $reportId])]]);
    }
}