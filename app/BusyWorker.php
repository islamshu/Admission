<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusyWorker extends Model
{
    /**
     * Get the user that owns the BusyWorker
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }
}
