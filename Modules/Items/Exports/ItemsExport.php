<?php

namespace Modules\Items\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Items\Entities\Item;

class ItemsExport implements FromView
{
    use Exportable;
    /**
     * Module Name
     *
     * @var string
     */
    protected $module;

    public function __construct($module)
    {
        $this->module = $module;
    }

    public function view(): View
    {
        return view(
            'items::exports.items',
            [
            'items' => Item::where('itemable_type', get_class(classByName($this->module)))->with(
                ['itemable' => function ($query) {
                    $query->whereNull('archived_at');
                }]
            )->get(),
            ]
        );
    }
}
