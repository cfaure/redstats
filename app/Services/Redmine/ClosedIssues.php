<?php namespace App\Services\Redmine;

use App\ICollector;
use App\Issue;

class ClosedIssues implements ICollector
{
    /**
     * Retourne le nombre de tickets fermés
     * @return int
     */
    public function getValue()
    {
        return Issue::closed()->count();
    }
}
