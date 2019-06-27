<?php

namespace Modules\Updates\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UpgradeController extends Controller
{
    /**
     * Perform upgrade.
     *
     * @return \Illuminate\Http\Response
     */
    public function lang($language = 'english')
    {
        // TODO import language files
        define('APPPATH', '');
        $corepath = base_path('resources/language/' . $language . '/fx_lang.php');
        $authpath = base_path('resources/language/' . $language . '/tank_auth_lang.php');
        if (Storage::disk('local')->exists($corepath) || Storage::disk('local')->exists($authpath)) {
            include $corepath;
            include $authpath;
            $string = '<?php' . "\n" . '/*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used system wide
    |
    */' . "\n" . 'return [' . "\n\n";

            foreach ($lang as $key => $l) {
                $l = addslashes($l);
                $string .= "'{$key}' => '{$l}',\n";
            }
            $string = $string . "\n];";
            $code   = getLangCode($language);
            if (Storage::disk('res')->put("lang/{$code}/core.php", $string)) {
                Storage::disk('res')->deleteDirectory("language/{$language}/");
            }

            return $language . ' migrated successfully';
        } else {
            return response()->json('Copy language files to ROOT/resources/ folder');
        }

        // return view('upgrade.lang')->with('language', $language);
    }
}
