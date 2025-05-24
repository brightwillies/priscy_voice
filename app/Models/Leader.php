<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Leader extends Model
{
    //
    protected $appends = ['status_name'];


    public function getStatusNameAttribute()
    {
        $statusName = '';
        $getStatus = $this->status;
        if ($getStatus == 0) {
            $statusName = 'Inactive';
        } elseif ($getStatus == 1) {
            $statusName = 'Active';
        }
        return $this->attributes['status_name'] = $statusName;
    }
}
