<?php

namespace Modules\Deals\Http\Controllers\Base;

use App\Entities\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Deals\Entities\Deal;

abstract class SetupController extends Controller
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

    public function ajaxStages()
    {
        $stages = Category::whereModule('deals')->wherePipeline($this->request->pipeline)->get();
        $str    = '<option value="">Select Stages</option>';
        foreach ($stages as $stage) {
            $str = $str . '<option value="' . $stage->id . '">' . $stage->name . '</option>';
        }

        return $str;
    }

    public function moveStage()
    {
        $category = Category::findOrFail($this->request->target);
        $deal     = Deal::findOrFail($this->request->id);
        $deal->update(['stage_id' => $this->request->target]);

        return langapp(
            'deal_stage_changed',
            [
                'title' => $deal->title,
                'stage' => $category->name,
            ]
        );
        exit;
    }
}
