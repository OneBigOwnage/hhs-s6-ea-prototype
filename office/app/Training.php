<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property int    $id               Unique id of this training.
 * @property int    $ship_id          Ship ID for which this training is meant.
 * @property int    $concept_id       Concept ID from which this was originated.
 * @property string $communication_id UUID used for communication.
 * @property string $title            Title of the training.
 * @property string $instructions     The instructions to perform the training.
 * @property Date   $date             Date on which the training should be performed.
 * @property bool   $is_done          Whether or not the training is marked as complete.
 * @property string $feedback         Optional feedback from the ship crew.
 */
class Training extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date'    => 'datetime',
        'is_done' => 'bool'    ,
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $training) {
            $training->communication_id = strtoupper(Uuid::uuid4());
        });
    }

    /**
     * The ship that this training is to be performed on.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Ship
     */
    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    /**
     * The concept training from which this training originates.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|TrainingConcept
     */
    public function concept()
    {
        return $this->belongsTo(TrainingConcept::class);
    }
}
