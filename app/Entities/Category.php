<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Deals\Entities\Deal;
use Modules\Knowledgebase\Entities\Knowledgebase;
use Modules\Leads\Entities\Lead;

class Category extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function totalValue()
    {
        $total = 0;
        Deal::where(['stage_id' => $this->id, 'status' => 'open'])->whereNull('archived_at')->chunk(
            200,
            function ($deals) use (&$total) {
                foreach ($deals as $key => $deal) {
                    $value = $deal->deal_value;
                    if ($deal->currency != get_option('default_currency')) {
                        $total += convertCurrency($deal->currency, $value);
                    } else {
                        $total += $value;
                    }
                }
            }
        );

        return formatDecimal($total);
    }

    public function leadsValue()
    {
        $total = 0;
        Lead::where(['stage_id' => $this->id])->whereNull('archived_at')->chunk(
            200,
            function ($leads) use (&$total) {
                foreach ($leads as $key => $lead) {
                    $total += parseCurrency($lead->lead_value);
                }
            }
        );

        return formatDecimal($total);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'pipeline', 'pipeline');
    }

    public function totalDeals()
    {
        return Deal::whereStageId($this->id)->count();
    }

    public function AsPipeline()
    {
        return $this->whereId($this->pipeline)->first();
    }

    public function articles()
    {
        return $this->hasMany(Knowledgebase::class, 'group')->orderBy('id', 'desc');
    }

    public function scopeLeads($query)
    {
        return $query->whereModule('leads');
    }
    public function scopeDeals($query)
    {
        return $query->whereModule('deals');
    }
    public function scopeTasks($query)
    {
        return $query->whereModule('tasks');
    }
}
