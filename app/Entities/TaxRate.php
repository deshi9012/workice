<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'tax_rates';
}
