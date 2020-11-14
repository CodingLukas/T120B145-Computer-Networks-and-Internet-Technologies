<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'active',
        'user_id'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function getId()
    {
        return $this->id;
    }
}
