<?php
 
namespace App;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
 
class Client extends Authenticatable
{
    use HasApiTokens;
    protected $guarded=[];
    /**
     * Get all of the comments for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

}