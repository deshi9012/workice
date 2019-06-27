<?php

namespace App\Traits;

use App\Entities\FormMeta;

trait Customizable
{
    public function custom()
    {
        return $this->morphMany(FormMeta::class, 'customizable')->orderBy('id', 'desc');
    }

    public function saveCustom($custom)
    {
        if (count((array)$custom) > 0) {
            $this->custom()->delete();
            foreach ($custom as $key => $value) {
                $this->custom()->create(
                    [
                    'meta_key' => $key, 'meta_value' => is_array($value) ? json_encode($value) : $value
                    ]
                );
            }
        }
    }
}
