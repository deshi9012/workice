<?php

namespace App\Widgets\Expenses;

use Arrilot\Widgets\AbstractWidget;
use Modules\Expenses\Entities\Expense;

class OpenExpensesWidget extends AbstractWidget
{

     /**
      * The configuration array.
      *
      * @var array
      */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['expenses'] = Expense::where('billable', '1')->where('invoiced', '0')->with(['AsCategory', 'company'])
            ->orderBy('id', 'desc')->get();

        return view(
            'widgets.expenses.open_expenses_widget', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
