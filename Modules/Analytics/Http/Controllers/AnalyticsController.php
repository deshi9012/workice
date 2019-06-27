<?php

namespace Modules\Analytics\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Page displayed
     *
     * @var string
     */
    protected $page;
    /**
     * The module to be displayed in the dashboard
     *
     * @var string
     */
    protected $module;
    /**
     * The chart year
     *
     * @var string
     */
    protected $year;
    /**
     * \Illuminate\Http\Request instance
     *
     * @var \Illuminate\Http\Request
     */
    public $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->module  = request('m', 'invoices');
        $this->year    = chartYear();
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']   = $this->getPage();
        $data['module'] = $this->module;
        $data['year']   = $this->year;

        return view('analytics::index')->with($data);
    }

    public function view($type = null)
    {
        $data['range']      = array(date('Y-m') . '-01', date('Y-m-d'));
        $data['page']       = $this->getPage();
        $data['module']     = $this->module;
        $data['year']       = $this->year;
        $data['request']    = $this->request;
        $data['reportpage'] = $type;
        return view('analytics::_' . $this->module . '.' . $type)->with($data);
    }

    private function getPage()
    {
        return langapp('reports');
    }

    // public function ajaxInvoices()
    // {
    //     dd($this->request->all());
    //     $data['invoices'] = app('invoice')->apply($this->request)->with('company')->orderBy('id', 'desc')->paginate(30);
    //     return view('analytics::_invoices._ajax_invoices')->with($data);
    // }
}
