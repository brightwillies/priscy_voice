<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $getRecords = Event::select('*')->orderBy('id', 'DESC')->get();
        return $this->successResponse('', $getRecords);
    }

    public function store(Request $request)
    {

        // try {
        $rules = [
            'title' => 'required|unique:events,title',
            'date' => 'required',
            'venue' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }

        $newRecord = new Event();
        $newRecord->title = $request->title;
        $newRecord->date = $request->date;
         $newRecord->venue = $request->venue;
        $newRecord->status = $request->status;
        $newRecord->summary = $request->summary;
        $webImage = $request->file('featured_image');
        if ($webImage) {
            $uploadResult = uploadItemImage($webImage, $request->title, ST_EVENTS);
            if ($uploadResult) {
                $newRecord->image = $uploadResult->path;
                $newRecord->image_filename = $uploadResult->filename;
            }
        }

        $newRecord->mask = generate_mask();
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
        $newRecord = Event::where('mask', $id)->first();
        if (!$newRecord) {
            return $this->errorResponse('Resource not found');
        }
        return $this->successResponse('', $newRecord);
    }

    public function update(Request $request, $id)
    {

        $newRecord = Event::where('mask', $id)->first();
        if (!$newRecord) {
            return $this->errorResponse('Resource not found');
        }
        try {
            $rules = [
                'title' => 'required',
                'date' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }
            $newRecord->title = $request->title;
            $newRecord->date = $request->date;
            $newRecord->venue = $request->venue;
            // $newRecord->status = $request->status;
            $newRecord->summary = $request->summary;
            $webImage = $request->file('featured_image');
            if ($webImage) {
                $uploadResult = uploadItemImage($webImage, $request->title, ST_EVENTS);
                if ($uploadResult) {
                    $newRecord->image = $uploadResult->path;
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
        $newRecord = Event::where('mask', $id)->first();
        if (!$newRecord) {
            return $this->errorResponse('Resource not found');
        }
        $newRecord->delete();
        return $this->successResponse('Record Deleted Successfully');
    }

    public function dates()
    {
        $startdate = strtotime("Sunday");
        $enddate = strtotime("+6 weeks", $startdate);
        while ($startdate < $enddate) {
            $days[] = date("M d", $startdate);
            $startdate = strtotime("+1 week", $startdate);
        }
        return $this->successResponse('', $days);
    }

}
