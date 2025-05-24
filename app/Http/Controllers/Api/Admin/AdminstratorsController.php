<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $getRecords = User::orderBy('id', 'DESC')->get();
        return $this->successResponse('', $getRecords);
    }

    public function store(Request $request)
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
        $newRecord->role_id = $request->role_id;

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
    public function update(Request $request, $id)
    {
        $newRecord = User::where('mask', $id)->first();

        if (!$newRecord) {
            return $this->errorResponse('Record not found');
        }

        // try {
        $rules = [
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }
        // $loggedInUser = auth()->user();
        // $createdBy = $loggedInUser->id;

        $newRecord->first_name = $request->first_name;
        $newRecord->last_name = $request->last_name;
        // $newRecord->password = Hash::make($request->password);
        $newRecord->email = $request->email;
        $newRecord->telephone_number = $request->telephone_number;
        $newRecord->role_id = $request->role_id;
        $newRecord->status = (int) $request->status ?: ST_ACTIVE;
        // $newRecord->mask = generate_mask();
        if ($newRecord->save()) {

            return $this->successResponse(SUCCESS_UPDATING_MESSAGE);
        }
        return $this->errorResponse('Failed to process your request');
        // } catch (Exception $e) {

        //     return $this->errorResponse($e);
        // }
    }

    public function destroy($id)
    {
        $newRecord = User::where('mask', $id)->first();
        if (!$newRecord) {
            return $this->errorResponse('Resource not found');
        }
        deleteOldImage($newRecord->image_filename, ST_IMAGES);
        $newRecord->delete();
        return $this->successResponse('Record Deleted Successfully');
    }

}
