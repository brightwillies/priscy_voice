<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;


      protected $fillable = ['news_id', 'ip_address'];

       public function news()
    {
        return $this->belongsTo(News::class);
    }

}
