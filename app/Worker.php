<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;
    /**
     * Get the user that owns the Worker
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natonality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
