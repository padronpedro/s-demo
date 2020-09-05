<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * Projects-Members relationship
     *
     * @return App\Project
     */
    public function projects() {
        return $this->belongsToMany('App\Project');
    }
}
