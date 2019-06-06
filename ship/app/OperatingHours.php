<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class OperatingHours extends Model
{
    /**
     * The cache key that is used to store the IDs of the
     * records that still need to be synced to BigQuery.
     *
     * @var string
     */
    public const CACHE_KEY = 'OPERATING_HOUR_IDS_TO_SYNC';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device'      ,
        'hours'       ,
        'reading_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ 'hours' => 'integer' ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (OperatingHours $model) {
            $recordIDs = Cache::pull(static::CACHE_KEY, []);

            $recordIDs[] = $model->id;

            Cache::put(static::CACHE_KEY, $recordIDs);
        });
    }
}
