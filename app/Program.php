<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $fillable = [
        'name','description','image'
    ];


    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
