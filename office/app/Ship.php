<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property int    $id                The unique id of this ship
 * @property string $unique_identifier The unique identifier of this ship.
 * @property string $name              The name of this ship.
 */
class Ship extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $ship) {
            $ship->unique_identifier = strtoupper(Uuid::uuid4());
        });
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
