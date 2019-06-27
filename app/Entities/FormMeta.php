<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class FormMeta extends Model
{
    protected $guarded = [];
    protected $table = 'formmeta';
    public $timestamps = false;
    protected $casts = [
        'meta_value' => 'array'
    ];

    public function customizable()
    {
        return $this->morphTo();
    }

    public function field()
    {
        return $this->belongsTo(CustomField::class, 'field_id', 'id');
    }
}
