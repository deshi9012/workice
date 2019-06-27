<?php

namespace Modules\Payments\Helpers;

class PaymentEngine
{
    protected $gateway;
    protected $transaction;

    
    public function __construct($gateway, $transaction)
    {
        $this->transaction = $transaction;
        $this->gateway = $this->getPaymentGateway($gateway);
    }

    public function transact()
    {
        return $this->gateway->pay($this->transaction);
    }

    public function getPaymentGateway($gateway)
    {
        $className = "Modules\\Payments\\Gateways\\".ucfirst($gateway);

        if (! class_exists($className)) {
            throw new \Exception('Payment gateway implementation '.$className.' missing');
        }
        
        return new $className;
    }
}
