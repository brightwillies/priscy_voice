<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mediatable;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

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
        $url          = '';
        $image        = $request->file('image');
        $name         = 'file' . microtime();
        $uploadResult = uploadItemImage($image, $name, ST_IMAGES);

        if ($uploadResult) {
            $url = $uploadResult->path;
            // $newProductImage->image_filename = $uploadResult->filename;
        }
        $data        = [];
        $data['url'] = $url;
        return $this->successResponse('', $data);
    }

    public function storeMediaFiiles(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image     = $request->file('image');
        $mime_type = $request->file('image')->getMimeType();
        $name      = 'media_file' . microtime();

        $uploadResult = uploadItemImage($image, $name, ST_IMAGES);
        $newMediaFile = new Mediatable();
        if ($uploadResult) {
            $newMediaFile->filename  = $uploadResult->filename;
            $newMediaFile->path      = $uploadResult->path;
            $newMediaFile->mime_type = mime_type;
        }
        $newMediaFile->save();
        return $this->successResponse(SUCCESS_CREATING_MESSAGE);

    }

    public function indexMultiples(Request $request)
    {
        $mediaFiles = Mediatable::all();
        return $this->successResponse('', $mediaFiles);
    }

    public function storeMultiples(Request $request)
    {

        if (isset($request->images)) {
            if (count($request->images)) {
                foreach ($request->images as $key => $image) {
                    $mime_type = $image->getMimeType();
                    // $name         = 'media_file' . microtime() . $key;

                    $name         = 'media_file_' . $image->getClientOriginalName();
                    $uploadResult = uploadItemImage($image, $name, ST_MEDIA);

                    if ($uploadResult) {
                        $newMediaFile            = new Mediatable();
                        $newMediaFile->filename  = $name;
                        // $newMediaFile->filename  = $uploadResult->filename;
                        $newMediaFile->path      = $uploadResult->path;
                        $newMediaFile->mime_type = $mime_type;
                        $newMediaFile->save();
                    }
                }
            }
        }

        return $this->successResponse(SUCCESS_CREATING_MESSAGE);

    }

    public function deleteImage($id){

        $findFile = Mediatable::find($id);
        $findFile->delete();

        return $this->successResponse(SUCCESS_DELETING_MESSAGE);

    }

}
