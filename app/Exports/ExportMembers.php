<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use stdClass;

class ExportMembers implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {

        $returns = [];

        $fetchRecords = Member::all();

        foreach ($fetchRecords as $key => $sRecord) {

            $newrod = $sRecord->makeHidden(['id', 'mask', 'created_at', 'update_at']);
            $nRecord = new stdClass();
            $nRecord->title = $newrod->title;
            $nRecord->member = $newrod->fullname;
            $nRecord->email = $newrod->email;
            $nRecord->telephone_number = $newrod->telephone_number;
            $nRecord->gender = $newrod->gender;
            $nRecord->father = $newrod->father;
            $nRecord->mother = $newrod->mother;
            $nRecord->address = $newrod->address;
            $nRecord->registered_on = $newrod->registered_on;
            $nRecord->dob = $newrod->dob;
            $nRecord->memberid = $newrod->memberid;
            $nRecord->marital_status = $newrod->marital_status;
            $nRecord->confirmed_response = $newrod->confirmed_response;
            $nRecord->baptised_response = $newrod->baptised_response;
            $nRecord->children_response = $newrod->children_response;
            $returns[] = $nRecord;

        }

        return collect($returns);
    }

    public function headings(): array
    {

        return [
            "MR",
            "MEMBER",
            "EMAIL",
            "TELEPHONE NUMBER",
            "GENDER",
            "FATHER",
            "MOTHER",
            "ADDRESS",
            "REGISTERED ON",
            "DATE OF BIRTH ",
            "ID NUMBER",
            "CONFIRMED",
            "BAPTISED",
            "HAS CHILDREN",
        ];

    }
}
