<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
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
     * clients-project relationship
     *
     * @return App\Client
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Projects-Members relationship
     *
     * @return App\Members
     */
    public function members() {
        return $this->belongsToMany('App\Member');
    }
}
