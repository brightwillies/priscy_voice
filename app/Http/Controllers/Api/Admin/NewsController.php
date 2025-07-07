<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Comment;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $getRecords = News::select('*')->where('status', 1)->orderBy('date', 'DESC')->get();
        return $this->successResponse('', $getRecords);
    }
    public function unpublishedIndex()
    {
        $getRecords = News::select('*')->where('status', 0)->orderBy('date', 'DESC')->get();
        return $this->successResponse('', $getRecords);
    }

    public function store(Request $request)
    {

        // try {
        $rules = [
            'title' => 'required|unique:news,title',
            'date'  => 'required',
            // 'venue' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }

        $newRecord        = new News();
        $newRecord->title = $request->title;
        // $newRecord->date = gmdate('y-m-d');
        $newRecord->category_id  = $request->category_id;
        $newRecord->date         = $request->date;
        $newRecord->summary      = $request->summary;
        $newRecord->status       = $request->status;
        $newRecord->introduction = $request->introduction;
        $webImage                = $request->file('featured_image');
        if ($webImage) {
            $uploadResult = uploadItemImage($webImage, $request->title, ST_NEWS);
            if ($uploadResult) {
                $newRecord->image          = $uploadResult->path;
                $newRecord->image_filename = $uploadResult->filename;
            }
        }

        $newRecord->mask = Str::slug($request->title);
        if ($newRecord->save()) {

            return $this->successResponse(SUCCESS_CREATING_MESSAGE);
        }
        return $this->errorResponse('Failed to process your request');
        // } catch (Exception $e) {

        //     return $this->errorResponse($e);
        // }
    }

    public function show($id)
    {
        return $newRecord = News::where('id', $id)->first();
        if (! $newRecord) {
            return $this->errorResponse('Resource not found');
        }
        return $this->successResponse('', $newRecord);
    }
    public function blogComments($id)
    {
        return $newRecord = News::where('id', $id)->first();
        if (! $newRecord) {
            return $this->errorResponse('Resource not found');
        }

        $findComments        = Comment::where('news_id', $newRecord->id)->get();
        $newRecord->comments = findComments;
        return $this->successResponse('', $newRecord);
    }

    public function update(Request $request, $id)
    {

        $newRecord = News::where('mask', $id)->first();
        if (! $newRecord) {
            return $this->errorResponse('Resource not found');
        }
        try {
            $rules = [
                'title' => 'required',
                // 'date' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }
            $newRecord->title        = $request->title;
            $newRecord->date         = $request->date;
            $newRecord->summary      = $request->summary;
            $newRecord->category_id  = $request->category_id;
            $newRecord->introduction = $request->introduction;
            $newRecord->status       = $request->status;
            $webImage                = $request->file('featured_image');
            if ($webImage) {
                $uploadResult = uploadItemImage($webImage, $request->title, ST_NEWS);
                if ($uploadResult) {
                    $newRecord->image          = $uploadResult->path;
                    $newRecord->image_filename = $uploadResult->filename;
                }
            }
            if ($newRecord->save()) {
                return $this->successResponse(SUCCESS_UPDATING_MESSAGE);
            }
            return $this->errorResponse(ERROR_UPDATING_MESSAGE);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newRecord = News::where('mask', $id)->first();
        if (! $newRecord) {
            return $this->errorResponse('Resource not found');
        }
        $newRecord->delete();
        return $this->successResponse('Record Deleted Successfully');
    }
    public function deleteComment($id)
    {
        $newRecord = Comment::where('id', $id)->first();
        if (! $newRecord) {
            return $this->errorResponse('Resource not found');
        }
        $newRecord->delete();
        return $this->successResponse('Record Deleted Successfully');
    }

}
