<?php

namespace Modules\Contracts\Helpers;

use App\Contracts\PDFCreatorInterface;
use PDF;

class PDFCreator implements PDFCreatorInterface
{
    public function pdf($model, $download)
    {
        $filename = langapp('contract') . ' ' . $model->contract_title . '.pdf';
        $data['contract'] = $model;
        $data['sign'] = true;
        $pdf = PDF::loadView('contracts::pdf.contract', $data);
        if ($download) {
            return $pdf->download($filename);
        }
        return $pdf->stream();
    }
}
