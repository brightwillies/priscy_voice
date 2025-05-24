<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $appends = ['addnamee', 'day', 'mon', 'addname', 'status_name'];

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

    public function getAddnameAttribute()
    {
        if ($this->attributes['date']) {
            $mydate = $this->attributes['date'];
            $endDate = date('F', strtotime($mydate));
             $endDate = date('F jS, Y', strtotime($mydate));
        }

        return $this->attributes['addname'] = $endDate;
    }

    public function getDayAttribute()
    {
        if ($this->attributes['date']) {
            $mydate = $this->attributes['date'];
            $endDate = date('F', strtotime($mydate));
             $endDate = date('j', strtotime($mydate));
        }

        return $this->attributes['day'] = $endDate;

    }
    public function getMonAttribute()
    {
        if ($this->attributes['date']) {
            $mydate = $this->attributes['date'];
            $endDate = date('F', strtotime($mydate));
             $endDate = date('M', strtotime($mydate));
        }

        return $this->attributes['mon'] = $endDate;

    }

}
