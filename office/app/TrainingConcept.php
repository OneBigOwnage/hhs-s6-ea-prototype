<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id           The unique id of this concept.
 * @property string $title        The title of this concept.
 * @property string $instructions The instructions to perform the training.
 */
class TrainingConcept extends Model
{
    public function instances()
    {
        return $this->hasMany(Training::class);
    }
}
