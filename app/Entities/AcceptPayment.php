<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AcceptPayment extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public $primaryKey = 'method_id';
    protected $table = 'payment_methods';
}
