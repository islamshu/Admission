<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    /**
     * Get the user that owns the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id')->withTrashed();
    }
    public function comapny()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function user()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }
    
}
