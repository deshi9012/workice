<?php
namespace App\Contracts;

interface PDFCreatorInterface
{
    public function pdf($model, $download);
}
