<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Nationality extends Model
{
    use HasTranslations;
    protected $guarded=[];

    public $translatable = ['name'];
    /**
     * Get all of the comments for the Nationality
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function worker()
    {
        return $this->hasMany(Worker::class, 'nationality_id');
    }
}
