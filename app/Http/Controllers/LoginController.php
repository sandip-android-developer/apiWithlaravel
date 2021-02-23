<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use Illuminate\Support\Str;
use Hash;
class LoginController extends Controller
{
    public function Login(Request $request)
    {
        
        if($request->isMethod('POST'))
        {

            $email=ucfirst(trim($request->email));
            $password=trim($request->password);
            //$inertObj=new RegistrationModel();
            $isAvaialble=RegistrationModel::where('email',$email)->first();
            //$isAvaialble=RegistrationModel::find($inertObj->email);
            if($isAvaialble)
            {
                $isValidpassword=$isAvaialble->password;
                if(Hash::check($password,$isValidpassword))
                {
                  $api_token=str::random(40);
                  $update=RegistrationModel::find($isAvaialble->id);
                  $update->token=$api_token;
                  $update->save();
                  $response=['msg'=>'Successfully Login','status'=>'1','response_data'=>[$update]];
                return response()->json($response);
                }
                else{
                    $response=['message'=>'Password Invalid','status'=>'0'];
                    return response()->json($response);
                }
            }else{
                return $request->input();
            }
        }
    }
}
