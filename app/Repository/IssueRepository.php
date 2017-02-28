<?php namespace App\Repository;

/**
 * summary
 */
class IssueRepository
{
    public static function openIssues()
    {
        return Issue::join('issue_statuses as istat', 'status_id', 's.id')
            ->where('s.is_closed', 0);
    }
}
