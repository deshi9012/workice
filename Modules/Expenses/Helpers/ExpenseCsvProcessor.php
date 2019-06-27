<?php

namespace Modules\Expenses\Helpers;

use Modules\Expenses\Entities\Expense;

class ExpenseCsvProcessor
{
    /**
     * Import Expenses from CSV.
     */
    public function import(\Illuminate\Http\Request $request)
    {
        // $CSVStringBinder = new CSVBinderString();
        $data = \App\Entities\CsvData::findOrFail($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $column = [];
            foreach ($request->fields as $csvfield => $dbfield) {
                if (!is_null($dbfield)) {
                    if (in_array($dbfield, config('db-fields.expense'))) {
                        $column[$dbfield] = $row[$csvfield];
                    }
                }
            }
            $column['billable'] = $column['billable'] == 'true' ? 1 : 0;
            $column['invoiced'] = $column['invoiced'] == 'true' ? 1 : 0;
            Expense::create($column);
        }
    }
}
