<?php

namespace App\Traits;

use Modules\Files\Entities\FileUpload;

trait Uploadable
{
    public function files()
    {
        return $this->morphMany(FileUpload::class, 'uploadable')->orderBy('id', 'desc');
    }
}
