<?php

namespace Modules\Users\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Users\Entities\User;

class UsersExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view(
            'users::exports.users', [
            'users' => User::all(),
            ]
        );
    }
}
