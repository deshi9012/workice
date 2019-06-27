<?php

namespace App\ViewComponents;

use App\Services\FontRepository;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\View;

class FontComponent implements Htmlable
{
    protected $family;

    public function __construct(FontRepository $family)
    {
        $this->family = $family;
    }

    public function toHtml()
    {
        return View::make('partial.fonts')
            ->with('family', $this->family->systemFont())
            ->render();
    }
}
