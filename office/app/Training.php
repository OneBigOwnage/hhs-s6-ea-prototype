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
    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $training) {
            $training->communication_id = Uuid::uuid4();
        });
    }
}
