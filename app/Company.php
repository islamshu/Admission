<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get all of the comments for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booking()
    {
        return $this->hasMany(Booking::class, 'company_id')->withTrashed();
    }
    public function workers()
    {
        return $this->hasMany(Worker::class, 'company_id');
    }
}
