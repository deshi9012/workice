<?php

namespace Modules\Creditnotes\Helpers;

use App\Contracts\PDFCreatorInterface;
use PDF;

class PDFCreator implements PDFCreatorInterface
{
    public function pdf($model, $download)
    {
        $filename           = langapp('credit_note') . ' ' . $model->reference_no . '.pdf';
        $data['creditnote'] = $model;
        $image              = getStorageUrl(config('system.media_dir') . '/' . get_option('invoice_logo'));
        $data['logo']       = filter_var($image, FILTER_VALIDATE_URL) ? $image : config('app.url') . $image;
        $pdf                = PDF::loadView('creditnotes::pdf.creditnote', $data);
        if ($download) {
            return $pdf->download($filename);
        }
        return $pdf->stream();
    }
}
