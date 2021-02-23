<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;

class UpdateProfileController extends Controller
{
    //
    public function UpdateProfile(Request $request)
    {
     if ($request->isMethod('POST')) {
     	$first_name=ucfirst($request->first_name);
     	$last_name=ucfirst($request->last_name);
     	$mobile_number=ucfirst($request->mobile_number);
     	$api_token=trim($request->header('token'));
     	$isAvailable=RegistrationModel::where('token',$api_token)->first(['id','first_name','last_name','email','mobile_number','token']);
     	if ($isAvailable) {
     		# code..
     		$update=RegistrationModel::find($isAvailable->id);
     		$update->first_name=$first_name;
     		$update->last_name=$last_name;
     		$update->mobile_number=$mobile_number;
     		$update->save();
     	$response=['message'=>'Profile Updated Successfully','status'=>'1','responseData'=>[$update]];
     		return response()->json($response);
     	}
     	else{
 			  $response=['message'=>'Session Expire','status'=>'23'];
 			 return response()->json($response);
    		}

    	# code...
    }	
    }
   
}
