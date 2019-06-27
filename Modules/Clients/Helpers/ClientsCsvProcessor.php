<?php

namespace Modules\Clients\Helpers;

use Modules\Clients\Entities\Client;
use Modules\Users\Entities\User;

class ClientsCsvProcessor
{
    /**
     * Import Contacts from CSV.
     */
    public function import(\Illuminate\Http\Request $request)
    {
        $data = \App\Entities\CsvData::findOrFail($request->csv_data_file_id);
        $csvData = json_decode($data->csv_data, true);
        foreach ($csvData as $row) {
            $column = [];
            $client = new Client;
            foreach ($request->fields as $csvfield => $dbfield) {
                if (!is_null($dbfield)) {
                    if (in_array($dbfield, config('db-fields.client'))) {
                        $column[$dbfield] = $row[$csvfield];
                    }
                }
            }
            $contactEmail = $column['contact_email'];
            $contactPerson = $column['contact_person'];
            unset($column['contact_email']);
            unset($column['contact_person']);
            $company = $client->firstOrCreate(['email' => $column['email']], $column);
            if (filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
                $user = User::firstOrCreate(
                    ['email' => $contactEmail],
                    ['name' => $contactPerson]
                );
                $company->update(['primary_contact' => $user->id]);
                $user->profile()->update(['company' => $company->id]);
            }
        }
    }
}
