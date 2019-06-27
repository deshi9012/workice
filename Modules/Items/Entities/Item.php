<?php

namespace Modules\Items\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Items\Observers\ItemObserver;
use App\Traits\Observable;

class Item extends Model
{
    use SoftDeletes, Observable;

    protected static $observer = ItemObserver::class;
    protected static $scope    = null;
    
    protected $fillable = [
        'tax_rate','tax_total','quantity','unit_cost','discount','total_cost','name','description',
        'order','itemable_id','itemable_type'
    ];
    protected $dates = [
        'deleted_at'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'discount' => 'float',
        'tax_rate' => 'float',
        'quantity' => 'float',
        'unit_cost' => 'float',
        'total_cost' => 'float',
    ];

    public function itemable()
    {
        return $this->morphTo();
    }

    public function scopeTemplates($query)
    {
        return $query->whereItemableId(0);
    }

    public function setTaxRateAttribute($value)
    {
        $this->attributes['tax_rate'] = is_null($value) ? 0.00 : $value;
    }
}
