<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    /**
     * @var string
     */
    protected $table = "issues";

    /**
     * @return mixed
     */
    public function status()
    {
        return $this->hasOne(IssueStatus::class, 'id', 'status_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeStatusJoin($query)
    {
        return $query
            ->join('issue_statuses', 'status_id', 'issue_statuses.id');
    }

    /**
     * [openIssues description]
     * @return Illuminate\Database\Eloquent\Builder [description]
     */
    public function scopeOpen($query)
    {
        return $query
            ->statusJoin()
            ->where('issue_statuses.is_closed', 0);
    }

    /**
     * [openIssues description]
     * @return Illuminate\Database\Eloquent\Builder [description]
     */
    public function scopeClosed($query)
    {
        return $query
            ->statusJoin()
            ->where('issue_statuses.is_closed', 1);
    }
}
