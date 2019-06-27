<?php

namespace Modules\Deals\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Deals\Entities\Deal;

class DealsExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'deals::exports.deals', [
            'deals' => Deal::orderBy('id', 'desc')->get(),
            ]
        );
    }
}
