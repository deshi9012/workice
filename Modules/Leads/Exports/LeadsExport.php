<?php

namespace Modules\Leads\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Leads\Entities\Lead;

class LeadsExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'leads::exports.leads', [
            'leads' => Lead::orderBy('id', 'desc')->get(),
            ]
        );
    }
}
