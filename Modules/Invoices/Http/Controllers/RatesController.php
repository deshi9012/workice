<?php

namespace Modules\Invoices\Http\Controllers;

use App\Entities\TaxRate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invoices\Http\Requests\TaxRateRequest;

class RatesController extends Controller
{
    /**
     * TaxRate Model
     *
     * @var \App\Entities\TaxRate
     */
    protected $rates;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request, TaxRate $rates)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
        $this->rates   = $rates;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']  = langapp('tax_rates');
        $data['rates'] = $this->rates->all();

        return view('invoices::rates')->with($data);
    }
    /**
     * Show create rate modal
     */
    public function create()
    {
        return view('invoices::modal.add_rate');
    }
    /**
     * Save tax rate
     */
    public function save(TaxRateRequest $request)
    {
        $this->rates->create($request->all());
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = route('rates.index');

        return ajaxResponse($data);
    }
    /**
     * Show update tax rate modal
     */
    public function edit(TaxRate $rate)
    {
        $data['rate'] = $rate;

        return view('invoices::modal.update_rate')->with($data);
    }
    /**
     * Update tax rate
     */
    public function update(TaxRateRequest $request)
    {
        $rate = $this->rates->findOrFail($request->id);
        $rate->update($request->except('id'));
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = route('rates.index');

        return ajaxResponse($data);
    }
    /**
     * Confirm deleting tax rate
     */
    public function delete(TaxRate $rate)
    {
        $data['rate'] = $rate;

        return view('invoices::modal.delete_tax')->with($data);
    }
    /**
     * Delete tax rate
     */
    public function destroy(TaxRate $rate)
    {
        $rate->delete();
        toastr()->warning(langapp('deleted_successfully'), langapp('response_status'));

        return redirect()->route('rates.index');
    }
}
