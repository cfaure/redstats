<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var array
     */
    protected $dates = [];

    /**
     * @return mixed
     */
    public function measures()
    {
        return $this->hasMany(Measure::class);
    }

    /**
     * Collecte et enregistre une mesure en appelant la classe dédiée
     * définie pour l'indicateur.
     *
     * @return void
     */
    public function collectMeasure()
    {
        $className = 'App\Services\\' . $this->name;

        // Appelle le service de collection défini au niveau de l'indicateur
        // et enregistre la mesure correspondante
        if (!class_exists($className) || !is_a($className, 'App\ICollector', true)) {
            var_dump(!class_exists($className), !is_a($className, 'App\ICollector', true));
            throw new \Exception('Invalid collector class: ' . $className);
        }
        $value = (new $className)->getValue();
        $this->measures()->create([
            'value'     => $value,
            'issued_at' => Carbon::now(),
        ]);
    }

    /**
     * Retourne un tableau avec :
     *     'diff'        => la différence entre la valeur de la mesure passée en paramètre et sa valeur de réfernce
     *     'evo'         => évolution en % entre les 2 mesures
     *     'targetValue' => valeur de référence
     * @param Measure $m Mesure d'origine à comparer
     * @param RelativePeriod $p Quelle
     */
    public function compareMeasureTo(Measure $measure, RelativePeriod $period)
    {
        $relativeMeasure = $measure->getMeasureRelativeTo($period);
        return [
            'diff' => $measure->value,
            'evo'  => ($measure->value / $relativeMeasure) * 100.0,
        ];
    }
}
