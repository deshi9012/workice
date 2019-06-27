<?php

namespace Modules\Invoices\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Invoices\Entities\Invoice;
use Modules\Users\Entities\Profile;

class InvoicesExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'invoices::exports.invoices', [
            'invoices' => Invoice::whereNull('archived_at')->orderBy('id', 'desc')->get(),
            ]
        );
    }
}
