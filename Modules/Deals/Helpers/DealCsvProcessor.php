<?php

namespace Modules\Deals\Helpers;

use Modules\Deals\Entities\Deal;

class DealCsvProcessor
{
    /**
     * Import deals from CSV.
     */
    public function import(\Illuminate\Http\Request $request)
    {
        $data     = \App\Entities\CsvData::find($request->csv_data_file_id);
        $csvData = json_decode($data->csv_data, true);
        foreach ($csvData as $row) {
            $column = [];
            foreach ($request->fields as $csvfield => $dbfield) {
                if (!is_null($dbfield)) {
                    if (in_array($dbfield, config('db-fields.deal'))) {
                        $column[$dbfield] = $row[$csvfield];
                    }
                }
            }
            $column['status'] = strtolower($column['status']);
            $column['user_id'] = \Auth::id();
            Deal::firstOrCreate(['title' => $column['title']], $column);
        }
    }
}
