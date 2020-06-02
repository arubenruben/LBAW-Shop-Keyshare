<?php

namespace App\Policies;

use App\Report;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReportPolicy
{
    use HandlesAuthorization;

    public function canSee(User $user, Report $report) {
        // Only the own user can see his reports
        return Auth::check() && (Auth::id() === $report->reporter_id || Auth::id() === $report->reported_id);
    }
}
