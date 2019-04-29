<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property int    $id               Unique id of this training.
 * @property string $communication_id UUID used for communication.
 * @property string $title            Title of the training.
 * @property string $instructions     The instructions to perform the training.
 * @property Date   $date             Date on which the training should be performed.
 * @property bool   $is_done          Whether or not the training is marked as complete.
 * @property string $feedback         Optional feedback from the ship crew.
 */
class Training extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'is_done' => 'bool'
    ];
}
