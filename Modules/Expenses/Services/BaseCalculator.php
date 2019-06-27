<?php

namespace Modules\Expenses\Services;

use Modules\Expenses\Entities\Expense;

abstract class BaseCalculator
{
    protected $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function beforeTax()
    {
        return $this->expense->amount - $this->taxed();
    }

    public function taxed()
    {
        $tax = $this->expense->tax + $this->expense->tax2;
        return ($tax / 100) * $this->expense->amount;
    }
}
