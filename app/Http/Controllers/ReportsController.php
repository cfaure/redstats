<?php

namespace App\Http\Controllers;

use App\Issue;
use App\IssueStatus;

class ReportsController extends Controller
{
    /**
     * Show the reports page
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $issues_num = Issue::count();

        $open_issues_num = Issue::whereIn(
            'status_id', IssueStatus::open()->pluck('id')
        )->count();
        var_dump($open_issues_num);

        $open_issues_num = Issue::whereHas('status', function ($q) {
            return $q->where('is_closed', 0);
        })->count();

        $open_issues_num = Issue::open()->count();
        var_dump($open_issues_num);

        $open_issues_num = Issue::closed()->count();
        var_dump($open_issues_num);

        $open_issues_num = Issue::statusJoin()->where('issue_statuses.name', 'Nouveau')->count();
        var_dump($open_issues_num);

        return view('reports', compact('issues_num', 'open_issues_num'));
    }
}
