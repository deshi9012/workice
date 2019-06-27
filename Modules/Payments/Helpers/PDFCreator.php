<?php

namespace Modules\Payments\Helpers;

use App\Contracts\PDFCreatorInterface;
use PDF;

class PDFCreator implements PDFCreatorInterface
{
    public function pdf($model, $download)
    {
        $filename        = langapp('payment') . ' ' . $model->code . '.pdf';
        $data['payment'] = $model;
        $image           = getStorageUrl(config('system.media_dir') . '/' . get_option('invoice_logo'));
        $data['logo']    = filter_var($image, FILTER_VALIDATE_URL) ? $image : config('app.url') . $image;
        $pdf             = PDF::loadView('payments::pdf.payment', $data);
        if ($download) {
            return $pdf->download($filename);
        }
        return $pdf->stream();
    }
}
