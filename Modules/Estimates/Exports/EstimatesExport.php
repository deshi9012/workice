<?php

namespace Modules\Estimates\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Estimates\Entities\Estimate;

class EstimatesExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'estimates::exports.estimates', [
            'estimates' => Estimate::whereNull('archived_at')->orderBy('id', 'desc')->get(),
            ]
        );
    }
}
