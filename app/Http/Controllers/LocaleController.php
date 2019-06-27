<?php

namespace App\Http\Controllers;

use App\Entities\Language;
use Session;

class LocaleController extends Controller
{
    public function setLang($locale = null)
    {
        if (Language::select('code')->whereCode($locale)->where('active', 1)->count()) {
            Session::put('locale', $locale);
        }
        return redirect(url()->previous());
    }
}
