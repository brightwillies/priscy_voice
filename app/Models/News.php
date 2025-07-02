<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Likes;
use App\Models\Comment;
class News extends Model
{
    use HasFactory;

    protected $appends = ['comments', 'mon', 'day', 'category', 'year'];

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    public function likeCount()
    {
        return $this->likes()->count();
    }

    public function getCommentsAttribute()
    {

        $comments = Comment::where('news_id', $this->attributes['id'])->get();

        return $this->attributes['comments'] = $comments;
    }

    public function getCategoryAttribute()
    {
        $category = '';
        if ($this->attributes['category_id']) {
            $record = @Category::find($this->attributes['category_id']);
            if ($record) {
                $category = $record->name;
            }
        }
        return $this->attributes['category'] = $category;
    }

    public function getDayAttribute()
    {$endDate = '';
        if ($this->attributes['date']) {
            $mydate  = $this->attributes['date'];
            $endDate = date('j', strtotime($mydate));
        }

        return $this->attributes['day'] = $endDate;}
    public function getMonAttribute()
    {$endDate = '';

        if ($this->attributes['date']) {
            $mydate  = $this->attributes['date'];
            $endDate = date('M', strtotime($mydate));
        }

        return $this->attributes['mon'] = $endDate;}
    public function getYearAttribute()
    {$endDate = '';

        if ($this->attributes['date']) {

            $mydate  = $this->attributes['date'];
            $endDate = date('Y', strtotime($mydate));
            // $endDate = date('l, F jS, Y', strtotime($mydate));
        }

        return $this->attributes['year'] = $endDate;}
}
