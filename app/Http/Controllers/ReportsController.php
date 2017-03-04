<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Show the reports page
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $issues_num = Issue::count();

        // $open_issues_num = Issue::whereIn(
        //     'status_id', IssueStatus::open()->pluck('id')
        // )->count();
        // var_dump($open_issues_num);

        // $open_issues_num = Issue::whereHas('status', function ($q) {
        //     return $q->where('is_closed', 0);
        // })->count();

        // $open_issues_num = Issue::open()->count();
        // var_dump($open_issues_num);

        // $open_issues_num = Issue::closed()->count();
        // var_dump($open_issues_num);

        $open_issues_num = Issue::statusJoin()->where('issue_statuses.name', 'Nouveau')->count();
        $contracts_num   = DB::connection('gac_report')->table('grcf_contract')->whereNotIn('current_status', ['closed', 'cancelled'])->count();

        return view('reports', compact('issues_num', 'open_issues_num', 'contracts_num'));
    }
}
