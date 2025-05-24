<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     protected $appends = ['count'];


    public function getCountAttribute()
    {
        $getId = $this->id;
        $count = @News::where('category_id', $getId)->count();
        return $this->attributes['count'] = $count;
    }
}


