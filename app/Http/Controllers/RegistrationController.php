<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegistrationModel;
use Illuminate\Support\Str;
use Hash;
use Validator;
class RegistrationController extends Controller
{
    public function Registration(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $rules=[
              'first_name'=>'required',
              'last_name'=>'required',
              'email'=>'required|unique:registration',  
              'password'=>'required',
              'mobile_number'=>'required|min:10|max:12',
            ];
            $msg=[
                ''
            ]; 
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $response = ['msg'=>$validator->messages(),'status'=>'0'];
                return response()->json($response);
            }else{
                $first_name=ucfirst(trim($request->first_name));
                $last_name=ucfirst(trim($request->last_name));
                $mobile_number=trim($request->mobile_number);
                $password=trim($request->password);
                $email=trim($request->email);
                $insertObj=new RegistrationModel();
                $insertObj->first_name=$first_name;
                $insertObj->last_name=$last_name;
                $insertObj->email=$email;
                $insertObj->mobile_number=$mobile_number;
                $insertObj->password=Hash::make($password);
                $save=$insertObj->save();
                if($save)
                {
                    $api_token=Str::random(40);
                    $updateObj=RegistrationModel::find($insertObj->id);
                    $updateObj->token=$api_token;
                    $updateObj->save();
                    $response=['msg'=>'Successfully Register','status'=>'1','response_data'=>[$updateObj]];
                    return response()->json($response);
                }
    
            }
            //$this->validate($request,$rules);
           
        }else{
            $response=['msg'=>'Method Not Allowed','status'=>'0'];
                return response()->json($response);
        }
        



       // dd($request->input(),Str::random(40));

    }
}
