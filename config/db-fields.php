<?php

return [

    'invoice'  => [
        'reference_no', 'title', 'client_id', 'due_date', 'tax', 'tax2', 'discount', 'currency',
        'discount_percent', 'notes',
    ],
    'contact'  => [
        'email', 'name', 'company', 'job_title', 'city', 'country', 'phone', 'mobile',
        'skype', 'twitter', 'language', 'address', 'state', 'zip_code', 'website',
    ],
    'items'    => [
        'name', 'description', 'quantity', 'unit_cost', 'tax_rate',
    ],
    'client'   => [
        'name', 'email', 'contact_person', 'contact_email', 'phone', 'mobile', 'address1', 'address2', 'city', 'state',
        'zip_code', 'country', 'tax_number', 'currency',
    ],
    'lead'     => [
        'name', 'source', 'stage', 'job_title', 'company', 'phone', 'mobile', 'email', 'address',
        'address1', 'address2', 'city', 'state', 'zip', 'country', 'timezone', 'website',
        'skype', 'facebook', 'twitter', 'linkedin', 'lead_score', 'lead_value',
    ],
    'deal'     => [
        'title', 'stage_id', 'source', 'pipeline', 'currency', 'deal_value', 'contact_person', 'organization',
        'due_date', 'status', 'won_time', 'lost_time', 'lost_reason',
    ],
    'estimate' => [
        'reference_no', 'title', 'client_id', 'due_date', 'tax', 'tax2', 'discount', 'currency',
        'discount_percent', 'notes', 'status',
    ],
    'expense'  => [
        'code', 'expense_date', 'client_id', 'project_id', 'currency', 'billable', 'amount', 'category',
        'tax', 'tax2', 'notes', 'invoiced',
    ],
];
