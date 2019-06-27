<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['status', 'color'];
    protected $table = 'status';
    public $timestamps = false;
}
