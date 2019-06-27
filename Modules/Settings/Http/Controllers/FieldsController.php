<?php

namespace Modules\Settings\Http\Controllers;

use App\Entities\CustomField;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
    }

    public function save()
    {
        CustomField::whereModule($this->request->module)->whereDeptid($this->request->deptid)->delete();

        $formdata = json_decode($this->request->formcontent);
        $order    = 1;
        foreach ($formdata->fields as $key => $f) {
            $uid  = isset($f->uniqid) ? genUnique() : $this->request->uniqid;
            $data = [
                'label'         => $f->label,
                'module'        => $this->request->module,
                'deptid'        => $this->request->deptid,
                'name'          => underscore(clean($f->label)),
                'uniqid'        => $uid,
                'type'          => $f->field_type,
                'required'      => $f->required,
                'field_options' => $f->field_options,
                'cid'           => $f->cid,
                'order'         => $order++,
            ];
            CustomField::updateOrCreate(
                ['name' => underscore(clean($f->label)), 'module' => $this->request->module, 'deptid' => $this->request->deptid],
                $data
            );
        }

        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = route('settings.index', ['section' => 'fields']);

        return ajaxResponse($data);
    }

    public function selectModule()
    {
        $data['page']       = langapp('settings');
        $data['module']     = $this->request->module;
        $data['section']    = 'fields';
        $data['department'] = $this->request->department;
        $data['fields']     = CustomField::whereModule($this->request->module)->whereDeptid($this->request->department)->orderBy('order', 'desc')->get();

        return view('settings::field_builder')->with($data);
    }
}
