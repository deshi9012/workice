<?php

namespace Modules\Contacts\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Users\Entities\Profile;

class ContactsExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'contacts::exports.contacts', [
            'contacts' => Profile::where('company', '>', 0)->get(),
            ]
        );
    }
}
