<?php

namespace App\Exceptions;

use Exception;

class PurNotVerifiedException extends Exception
{
    /**
     * The exception description.
     *
     * @var string
     */
    protected $message = 'Application License not valid';
}
