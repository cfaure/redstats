<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Measure extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * FIXME: indicator_id should not be fillable
     * @var array
     */
    protected $fillable = ['indicator_id', 'value', 'issued_at'];

    /**
     * @var array
     */
    protected $dates = ['issued_at'];

    /**
     * @var mixed
     */
    public $timestamps = false;

    /**
     * @return mixed
     */
    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    /**
     * @param RelativePeriod $interval
     */
    public function getMeasureRelativeTo($interval)
    {
        // TODO: gérer le cas de l'intervalle : "PREVIOUS"
        return DB::connection('mysql')->select(
            "SELECT *, DATEDIFF(?, issued_at) FROM
            (
                (SELECT id, value, issued_at FROM measures WHERE DATE(issued_at) >= DATE(?) - INTERVAL $interval and indicator_id = ? ORDER BY issued_at LIMIT 1)
                UNION ALL
                (SELECT id, value, issued_at FROM measures WHERE DATE(issued_at) < DATE(?) - INTERVAL $interval and indicator_id = ? ORDER BY issued_at DESC LIMIT 1)
            ) as t
            ORDER BY issued_at DESC LIMIT 2",
            [
                $this->issued_at,
                $this->issued_at, $this->indicator_id,
                $this->issued_at, $this->indicator_id,
            ]
        );
    }
}
