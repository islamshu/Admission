<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Privacy extends Model
{
    protected $guarded =[];
    public $translatable = ['title','body'];

}
