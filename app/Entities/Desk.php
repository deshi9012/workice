<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Desk extends Model {
    protected $guarded = [];
    public $timestamps = false;
    public $primaryKey = 'id';
    protected $table = 'desks';
}
