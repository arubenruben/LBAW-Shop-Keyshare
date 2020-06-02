<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show($reportId)
    {
        $report = Report::findOrFail($reportId);

        try {
            $this->authorize('canSee', User::class);
        } catch (AuthorizationException $e) {
            return response(json_encode($e->getMessage()), 400);
        }

        return view('pages.', ['report' => $report, 'breadcrumbs' => ['Report details' =>
            route('showReport', ['id' => $reportId])]]);
    }
}