<?php

namespace Modules\Settings\Http\Controllers;

use App\Entities\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Currency Model
     *
     * @var Currency
     */
    protected $currency;

    public function __construct(Request $request, Currency $currency)
    {
        $this->request = $request;
        $this->currency = $currency;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('settings::modal.create_currency');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CurrencyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(CurrencyRequest $request)
    {
        \Cache::forget('workice-currencies');
        $this->currency->create($request->all());
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = route('settings.index', ['section' => 'currencies']);

        return ajaxResponse($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id = null)
    {
        $data['currency'] = $this->currency->findOrFail($id);
        return view('settings::modal.edit_currency')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CurrencyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CurrencyRequest $request, $id = null)
    {
        \Cache::forget('workice-currencies');
        $cur = $this->currency->findOrFail($id);
        $cur->update($request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = route('settings.index', ['section' => 'currencies']);

        return ajaxResponse($data);
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  string $id
     * @return \Illuminate\View\View
     */
    public function delete($id = null)
    {
        $data['currency'] = $this->currency->findOrFail($id);
        return view('settings::modal.delete_currency')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return mixed
     */
    public function destroy($id = null)
    {
        \Cache::forget('workice-currencies');
        $cur = $this->currency->findOrFail($id);
        if ($cur->code == 'USD') {
            $error = \Illuminate\Validation\ValidationException::withMessages(
                [
                        'currency' => ['You are not allowed to delete base currency'],
                ]
            );
            throw $error;
        }
        $cur->delete();
        $data['message']  = langapp('deleted_successfully');
        $data['redirect'] = route('settings.index', ['section' => 'currencies']);

        return ajaxResponse($data);
    }
}
