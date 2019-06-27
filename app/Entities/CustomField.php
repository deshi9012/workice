<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $guarded = [];
    protected $table = 'fields';
    public $timestamps = false;
    protected $casts = [
        'field_options' => 'array',
    ];

    public function scopeExpenses($query)
    {
        return $query->where('module', 'expenses');
    }
    public function scopeDeals($query)
    {
        return $query->where('module', 'deals');
    }
    public function scopeLeads($query)
    {
        return $query->where('module', 'leads');
    }
    public function scopeEstimates($query)
    {
        return $query->where('module', 'estimates');
    }
    public function scopeInvoices($query)
    {
        return $query->where('module', 'invoices');
    }
    public function scopeTickets($query)
    {
        return $query->where('module', 'tickets');
    }
}
