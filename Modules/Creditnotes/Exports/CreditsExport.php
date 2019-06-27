<?php

namespace Modules\Creditnotes\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Creditnotes\Entities\CreditNote;

class CreditsExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'creditnotes::exports.credits', [
            'credits' => CreditNote::whereNull('archived_at')->orderBy('id', 'desc')->get(),
            ]
        );
    }
}
