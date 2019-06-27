<?php

namespace Modules\Invoices\Helpers;

use Modules\Invoices\Entities\Invoice;

class InvoiceCsvProcessor
{
    /**
     * Import Invoices from CSV.
     */
    public function import(\Illuminate\Http\Request $request)
    {
        $data = \App\Entities\CsvData::findOrFail($request->csv_data_file_id);
        $csvData = json_decode($data->csv_data, true);
        foreach ($csvData as $row) {
            $model = new Invoice;
            $column = [];
            $item = [];
            foreach ($request->fields as $csvfield => $dbfield) {
                if (!is_null($dbfield)) {
                    if (in_array($dbfield, config('db-fields.invoice'))) {
                        $column[$dbfield] = $row[$csvfield];
                    }
                    if (in_array($dbfield, config('db-fields.items'))) {
                        $item[$dbfield] = $row[$csvfield];
                    }
                }
            }
            $modelExist = $model->whereReferenceNo($column['reference_no'])->first();
            if (count($modelExist) == 0) {
                $model = $model->create($column);
            } else {
                $model = $modelExist;
            }
            $model->items()->create($item);
        }
    }
}
