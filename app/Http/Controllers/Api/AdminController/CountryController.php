<?php

namespace App\Http\Controllers\Api\AdminController;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;
use Validator;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('id' , 'desc')->get();
        return ApiController::respondWithSuccess(CountryResource::collection($countries));
    }
    public function create(Request $request)
    {
        $rules = [
            'name_ar'   => 'required|string|max:191',
            'name_en'   => 'required|string|max:191',
            'currency_ar' => 'required|string|max:191',
            'currency_en' => 'required|string|max:191',
            'code'        => 'required|max:191',
            'currency_code' => 'sometimes',
            'flag'        => 'required|mimes:jpg,jpeg,png,gif,tif,psd,bmp|max:5000',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return ApiController::respondWithErrorArray(validateRules($validator->errors(), $rules));

        // create new country
        $country = Country::create([
            'name_ar'        => $request->name_ar,
            'name_en'        => $request->name_en,
            'currency_ar'    => $request->currency_ar,
            'currency_en'    => $request->currency_en,
            'code'           => $request->code,
            'currency_code'  => $request->currency_code,
            'flag'           => $request->flag == null ? null : UploadImage($request->file('flag') , 'flag' , '/uploads/flags'),
        ]);
        return ApiController::respondWithSuccess(new CountryResource($country));
    }
    public function show($id)
    {
        $country = Country::find($id);
        if ($country)
        {
            return ApiController::respondWithSuccess(new CountryResource($country));
        }else{
            $error = ['message' => trans('messages.not_found')];
            return ApiController::respondWithErrorNOTFoundObject($error);
        }
    }
    public function edit(Request $request , $id)
    {
        $rules = [
            'name_ar'   => 'required|string|max:191',
            'name_en'   => 'required|string|max:191',
            'currency_ar' => 'required|string|max:191',
            'currency_en' => 'required|string|max:191',
            'code'        => 'required|max:191',
            'currency_code' => 'sometimes',
            'flag'        => 'required|mimes:jpg,jpeg,png,gif,tif,psd,bmp|max:5000',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return ApiController::respondWithErrorArray(validateRules($validator->errors(), $rules));

        $country = Country::find($id);
        if ($country)
        {
            $country->update([
                'name_ar'        => $request->name_ar,
                'name_en'        => $request->name_en,
                'currency_ar'    => $request->currency_ar,
                'currency_en'    => $request->currency_en,
                'code'           => $request->code,
                'currency_code'  => $request->currency_code == null ? $country->currency_code : $request->currency_code,
                'flag'           => $request->flag == null ? $country->flag : UploadImageEdit($request->file('flag') , 'flag' , '/uploads/flags' , $country->flag),
            ]);
            return ApiController::respondWithSuccess(new CountryResource($country));
        }else{
            $error = ['message' => trans('messages.not_found')];
            return ApiController::respondWithErrorNOTFoundObject($error);
        }
    }
    public function destroy($id)
    {
        $country = Country::find($id);
        if ($country){
            if (isset($country->flag))
            {
                @unlink(public_path('/uploads/flags/' . $country->flag));
            }
            $country->delete();
            $success = [
                'message' => trans('messages.deleted')
            ];
            return ApiController::respondWithSuccess($success);
        }else{
            $error = ['message' => trans('messages.not_found')];
            return ApiController::respondWithErrorNOTFoundObject($error);
        }
    }


}
