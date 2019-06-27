<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewTypeController extends Controller
{
    public function setView($type = null, $view = 'kanban')
    {
        switch ($type) {
        case 'tasks':
            session(['taskview' => $view]);
            break;
        case 'deals':
            session(['dealview' => $view]);
            break;
        default:
            break;
        }
        return redirect(url()->previous());
    }

    public function activeCalendar($view = null)
    {
        activeCalendar($view);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));
        return redirect(url()->previous());
    }
}
