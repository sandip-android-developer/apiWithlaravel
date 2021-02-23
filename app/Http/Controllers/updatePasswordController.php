<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use Hash;

class updatePasswordController extends Controller
{
    //
    public function UpdatePassword(Request $request)
    {
    	if ($request->isMethod('POST')) 
    	{
    		$api_token=trim($request->header('token'));
    		$old_password=trim($request->old_password);
    		$new_password=trim($request->new_password);
    		$isAvaialble=RegistrationModel::where('token',$api_token)->first(['id','password']);
    		if ($isAvaialble) 
    		{
    			$isValidpassword=$isAvaialble->password;
    			if (Hash::check($old_password,$isValidpassword)) 
    			{
    				$update=RegistrationModel::find($isAvaialble->id);
    				$update->password=Hash::make($new_password);
    				$update->save();
    				$response=['message'=>'Password Updated Successfully','status'=>'1'];
    				return response()->json($response);
    			}
    	  		else{
    				$response=['message'=>'Old Password is invalid','status'=>'0'];
    				return response()->json($response);
    			}
    		}
    		else
    		{
				$response=['message'=>'Session Expire','status'=>'23'];
    			return response()->json($response);
    		}
    		
    	}
    }
}
