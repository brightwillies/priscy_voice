<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\User;
use App\Models\Leader;
use App\Models\Teammember;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LeadershipController extends Controller
{
    use ResponseTrait;
   
   
    public function index()
    {
        $getRecords = Teammember::orderBy('id', 'DESC')->get();
        return $this->successResponse('', $getRecords);
    }

   
    public function store(Request $request)
    {

         try {
        $rules = [
            'name' => 'required|unique:teammembers,name',
            'position' => 'required',
            // 'title' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }

        $newRecord = new Teammember();
        $newRecord->name = $request->name;
        $newRecord->position = $request->position;
        
        $webImage = $request->file('featured_image');
        if ($webImage) {
            $uploadResult = uploadItemImage($webImage, $request->name, ST_LEADERS);
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
        } catch (Exception $e) {

            return $this->errorResponse($e);
        }
    }

    
    public function update(Request $request, $id)
    {
        $newRecord = Teammember::where('mask', $id)->first();
        if (!$newRecord) {
            return $this->errorResponse('Resource not found');
        }
        try {
            $rules = [

                'position' => "required",
                'name' => "required",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }
            $newRecord->name = $request->name;
            $newRecord->position = $request->position;
            $webImage = $request->file('featured_image');
            if ($webImage) {
                $uploadResult = uploadItemImage($webImage, $request->name, ST_LEADERS);
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

    public function destroy($id)
    {
        $newRecord = Teammember::where('mask', $id)->first();
        if (!$newRecord) {
            return $this->errorResponse('Resource not found');
        }
        deleteOldImage($newRecord->image_filename, ST_IMAGES);
        $newRecord->delete();
        return $this->successResponse('Record Deleted Successfully');
    }




    public function indexAdmin()
    {
        $getRecords = User::orderBy('id', 'DESC')->get();
        return $this->successResponse('', $getRecords);
    }

    public function storeAdmin(Request $request)
    {

        // try {
        $rules = [
            'email' => 'required|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }
        $loggedInUser = auth()->user();
        $createdBy = $loggedInUser->id;

        $newRecord = new User();
        $newRecord->first_name = $request->first_name;
        $newRecord->last_name = $request->last_name;
        $newRecord->password = Hash::make($request->password);
        $newRecord->email = $request->email;
        $newRecord->telephone_number = $request->telephone_number;

        $newRecord->status = (int) $request->status ?: ST_ACTIVE;
        $newRecord->mask = generate_mask();
        if ($newRecord->save()) {

            return $this->successResponse(SUCCESS_CREATING_MESSAGE);
        }
        return $this->errorResponse('Failed to process your request');
        // } catch (Exception $e) {

        //     return $this->errorResponse($e);
        // }
    }



}
