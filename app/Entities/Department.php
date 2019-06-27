<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];
    public $primaryKey = 'deptid';
    public $timestamps = false;
}
