<?php

namespace Modules\Payments\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PaymentsExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'payments::exports.payments', [
            'payments' => \Modules\Payments\Entities\Payment::orderBy('id', 'desc')->get(),
            ]
        );
    }
}
