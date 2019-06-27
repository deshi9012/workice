<?php

namespace Modules\Clients\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Clients\Entities\Client;

class ClientsExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'clients::exports.clients', [
            'clients' => Client::whereNotNull('email')->orderBy('id', 'desc')->get(),
            ]
        );
    }
}
