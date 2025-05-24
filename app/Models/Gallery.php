<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $appends = ['status_name', 'thumbnail','creator', 'images', 'addname'];

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
    public function getCreatorAttribute()
    {
        $creator = '';

        if ($this->attributes['created_by']) {
            $user = @User::find($this->attributes['created_by']);
            if ($user) {
                $creator = $user->first_name . ' ' . $user->last_name;
            }
        }

        return $this->attributes['creator'] = $creator;
    }

    public function getThumbnailAttribute()
    {

        $getId = $this->id;
        $image = '';
        $getImage = @GalleryImage::where('gallery_id', $getId)->first();

        if (!empty($getImage)) {
            $image = $getImage->image;
        }
        return $this->attributes['thumbnail'] = $image;
    }

    public function getAddnameAttribute()
    {
        $endDate = '';

        if ($this->attributes['date']) {

            $mydate = $this->attributes['date'];
            $endDate = date('F j, Y', strtotime($mydate));
        }

        return $this->attributes['addname'] = $endDate;
    }



    public function getImagesAttribute()
    {
        $imageArray = [];
        $getId = $this->id;

        $getProductId = $this->id;
        $getImages = @GalleryImage::where('gallery_id', $getProductId)->get();
        if ($getImages->isNotEmpty()) {
            foreach ($getImages as $key => $singImage) {
                $imageArray[] = array('id' => $singImage->id, 'image' => $singImage->image);
            }
            // foreach ($getImages as $key => $singImage) {
            //     $imageArray[] = $singImage->image;
            // }
        }

        return $this->attributes['images'] = $imageArray;
    }
}
