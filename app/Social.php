<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
        'type', 'value',
    ];
    public $timestamps = false;


   
    public static function setValue($key, $value)
    {
        static::query()->updateOrCreate([
            'type' => $key,
        ], [
            'value' => $value,
        ]);
    }
}