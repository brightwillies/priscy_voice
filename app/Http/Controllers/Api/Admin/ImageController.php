<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class ImageController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = '';
        $image = $request->file('image');
        $name = 'file' . microtime();
        $uploadResult = uploadItemImage($image, $name, ST_IMAGES);

        if ($uploadResult) {
            $url = $uploadResult->path;
            // $newProductImage->image_filename = $uploadResult->filename;
        }
        $data = array();
        $data['url'] = $url;
        return $this->successResponse('', $data);
    }


}
