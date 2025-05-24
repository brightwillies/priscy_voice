<?php

namespace App\Exports;

use App\Models\Attendance as modelAttendance;
use App\Models\Member;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use stdClass;

class Attendance implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($day = null, $filter = null)
    {
        $this->date = $day;
        $this->filter = $filter;
    }
    public function collection()
    {

        $returnArray = [];

        if ($this->date != null && $this->filter != null) {

            if ($this->filter == "all") {
                $members = Member::all();
            }

            if ($this->filter == "allmales") {
                $members = Member::where('gender', 'male')->get();
            }
            if ($this->filter == "allfemales") {
                $members = Member::where('gender', 'femalemale')->get();
            }
            //

            if ($members->isNotEmpty()) {
                foreach ($members as $key => $singlemember) {

                    $nRecord = new stdClass();

                    $nRecord->date = $this->date;
                    $nRecord->fullname = $singlemember->fullname;
                    $nRecord->gender = $singlemember->gender;
                    $nRecord->telephone_number = $singlemember->telephone_number;

                    $findRecord = @modelAttendance::where('mask', $singlemember->mask)->whereDate('day', $this->date)->first();
                    if ($findRecord) {
                        $nRecord->attend = 'Yes';
                    } else {
                        $nRecord->attend = 'No';
                    }

                    $returnArray[] = $nRecord;
                }
            }

        }else{
            $members = Member::all();
            $date = gmdate('Y-m-d');
            if ($members->isNotEmpty()) {
                foreach ($members as $key => $singlemember) {

                    $nRecord = new stdClass();

                    $nRecord->date = $date;
                    $nRecord->fullname = $singlemember->fullname;
                    $nRecord->gender = $singlemember->gender;
                    $nRecord->telephone_number = $singlemember->telephone_number;

                    $findRecord = @modelAttendance::where('mask', $singlemember->mask)->whereDate('day', $date)->first();
                    if ($findRecord) {
                        $nRecord->attend = 'Yes';
                    } else {
                        $nRecord->attend = 'No';
                    }

                    $returnArray[] = $nRecord;
                }
            }
        }

        return collect($returnArray);
    }

    public function headings(): array
    {

        return [
            "MARKED ON",
            "MEMBER",
            "GENDER",
            "TELEPHONE NUMBER",
            "IN ATTENDANCE",

        ];

    }
}
