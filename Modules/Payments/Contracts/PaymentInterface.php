<?php
namespace Modules\Payments\Contracts;

use Illuminate\Http\Request;

interface PaymentInterface
{
    public function pay($data);
    public function getData($data);
}
