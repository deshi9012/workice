<?php

namespace Modules\Expenses\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Expenses\Entities\Expense;

class ExpensesExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'expenses::exports.expenses', [
            'expenses' => Expense::get(),
            ]
        );
    }
}
