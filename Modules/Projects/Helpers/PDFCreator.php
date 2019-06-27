<?php

namespace Modules\Projects\Helpers;

use App\Contracts\PDFCreatorInterface;
use PDF;

class PDFCreator implements PDFCreatorInterface
{
    public function pdf($model, $download)
    {
        $filename = langapp('project') . ' ' . $model->name . '.pdf';
        $data['project'] = $model;
        $pdf = PDF::loadView('projects::pdf.project', $data);
        if ($download) {
            return $pdf->download($filename);
        }
        return $pdf->stream();
    }
}
