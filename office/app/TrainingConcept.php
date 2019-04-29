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
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * All trainings that were instantiated from this training.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Training
     */
    public function instances()
    {
        return $this->hasMany(Training::class);
    }
}
