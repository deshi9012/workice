<?php
namespace App\Contracts;

interface EventCreatorInterface
{
    public function logEvent($model);
}
