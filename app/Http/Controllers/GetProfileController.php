<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;

class GetProfileController extends Controller
{
    //
    public function GetProfile(Request $request)
    {

    	if ($request->isMethod('get')) 
    	{
    		//dd($request->header('token'));
    		//$data=header('token');
			$api_token=trim($request->header('token'));
			//dd($data);
			  $isAvaialble=RegistrationModel::where('token',$api_token)->first(['id','first_name','last_name','email','mobile_number','token']);
			if ($isAvaialble) {
			# code...
			//$getData=RegistrationModel::->find($isAvaialble->id);
			$response=['message'=>"Profile data get Successfully",'status'=>'1','response_data'=>[$isAvaialble]];
			return response()->json($response);
			}
		   else
			{
 			  $response=['message'=>'Session Expire','status'=>'23'];
 			 return response()->json($response);
    		}
		}
    }
}
