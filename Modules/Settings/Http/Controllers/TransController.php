<?php

namespace Modules\Settings\Http\Controllers;

use App\Entities\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransController extends Controller
{
    protected $transRepo;
    protected $request;

    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request, \Spatie\TranslationLoader\LanguageLine $transRepo)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->transRepo = $transRepo;
        $this->request   = $request;
    }

    public function create()
    {
        return view('settings::modal.create_language');
    }

    public function saveLanguage(\Modules\Settings\Http\Requests\LanguageRequest $request)
    {
        Language::create($request->all());
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = '/settings/translations';

        return ajaxResponse($data);
    }
    public function deleteLanguage()
    {
        $this->request->validate(['id' => 'required|numeric']);
        $lang = Language::findOrFail($this->request->id);
        $lang->delete();
        $data['message']  = langapp('deleted_successfully');
        $data['redirect'] = '/settings/translations';

        return ajaxResponse($data);
    }

    public function view($locale = null)
    {
        $data['page']    = $this->getPage();
        $data['section'] = 'translations';
        $data['lang']    = Language::whereCode($locale)->first();
        $data['files']   = ['app', 'activity'];

        return view('settings::translations.view')->with($data);
    }

    public function edit($locale = null, $file = null)
    {
        $data['page']     = $this->getPage();
        $data['section']  = 'translations';
        $data['lang']     = Language::whereCode($locale)->first();
        $data['filename'] = $file;
        $data['keys']     = \Lang::get($file, [], $locale);

        return view('settings::translations.edit')->with($data);
    }

    public function mail()
    {
        $data['page']    = $this->getPage();
        $data['section'] = 'translations';
        return view('settings::translations.mail')->with($data);
    }

    public function changeMail($locale = null)
    {
        $data['page']    = $this->getPage();
        $data['section'] = 'translations';
        $data['lang']    = Language::whereCode($locale)->first();
        $data['keys']    = \Lang::get('mail', [], $locale);

        return view('settings::translations.modify_mail')->with($data);
    }

    public function download()
    {
        $customTranslations = $this->transRepo->select('group', 'key', 'text')->get()->toJson();
        $fileName           = 'workice_translations_' . time() . '.json';
        \File::put(storage_path('app/tmp/' . $fileName), $customTranslations);
        return \Response::download(storage_path('app/tmp/' . $fileName));
    }

    public function upload()
    {
        return view('settings::modal.upload_translation');
    }

    public function restore()
    {
        $this->request->validate(['backup' => 'required|file|mimes:json,txt']);
        try {
            $file = file_get_contents($this->request->backup);
            $this->transRepo->truncate();
            foreach (json_decode($file, true) as $locale => $translations) {
                $this->transRepo->create($translations);
            }
            $data['message']  = langapp('changes_saved_successful');
            $data['redirect'] = '/settings/translations';

            return ajaxResponse($data);
        } catch (\Exception $e) {
            throw new \Exception('Error restoring uploaded translations');
        }
    }

    public function save()
    {
        $jpost    = array();
        $jsondata = json_decode(html_entity_decode($this->request->json));
        foreach ($jsondata as $jdata) {
            if ($jdata->value != trans($this->request->filename . '.' . $jdata->name, [], $this->request->locale)) {
                $l = [];
                foreach (languages() as $lang) {
                    $l[$lang['code']] = $lang['code'] != $this->request->locale ? trans($this->request->filename . '.' . $jdata->name, [], $lang['code']) : $jdata->value;
                }
                $this->transRepo->updateOrCreate(
                    [
                        'group' => $this->request->filename,
                        'key'   => $jdata->name,
                    ],
                    ['text' => $l]
                );
            }
        }
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function saveMail()
    {
        $jpost    = array();
        $jsondata = json_decode(html_entity_decode($this->request->json));
        foreach ($jsondata as $jdata) {
            if ($jdata->value != trans('mail.' . $jdata->name, [], $this->request->locale)) {
                $l = [];
                foreach (languages() as $lang) {
                    $l[$lang['code']] = $lang['code'] != $this->request->locale ? trans('mail.' . $jdata->name, [], $lang['code']) : $jdata->value;
                }
                $this->transRepo->updateOrCreate(
                    [
                        'group' => 'mail',
                        'key'   => $jdata->name,
                    ],
                    ['text' => $l]
                );
            }
        }
        \Cache::forget('spatie.translation-loader.mail.' . $this->request->locale);
        \Cache::forget('spatie.translation-loader.mail.en');
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function status($locale = null)
    {
        $language         = Language::whereCode($locale)->update(['active' => $this->request->active]);
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = '/settings/translations';
        \Cache::forget('active-lang');

        return ajaxResponse($data);
    }

    private function getPage()
    {
        return langapp('settings');
    }
}
