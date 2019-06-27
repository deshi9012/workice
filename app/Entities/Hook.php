<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Hook extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function children()
    {
        return $this->hasMany(self::class, 'parent', 'module')->where('visible', '1')->orderBy('order');
    }
    public function hasChild()
    {
        return $this->whereParent($this->module)->count();
    }
}
