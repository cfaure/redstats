<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * IssueStatus model
 */
class IssueStatus extends Model
{
    /**
     * @var string
     */
    protected $table = "issue_statuses";

    /**
     * @var string
     */
    protected $connection = 'redmine';

    /**
     * @return mixed
     */
    public function issues()
    {
        return $this->hasMany(Issue::class, 'status_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOpen($query)
    {
        return $query->where('is_closed', 0);
    }
}
