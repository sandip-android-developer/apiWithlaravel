<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Storage,URL;

class UploadImageController extends Controller
{
    //

    public function UploadImage(Request $request)
    {
    	if ($request->isMethod('POST')) {
    		# code...
    		$validator=validator::make($request->all(),
    			['image'=>'required|image:jpeg,png,jpg,gif']);
    		if ($validator->fails()) {

    			# code...
    			$response=['message'=>$validator->message()->first(),'status'=>'0'];
    			return response()->json($response);
    		}
    		$uploadFolder='apiForFlutter';
    		$image=$request->file('image');
    		$image_uploaded_path=$image->store($uploadFolder,'public');
    		$path=URL::asset('storage').'/'.$image_uploaded_path;
    		//dd($path);
    		/*$uplodedImageResponse=array('image_name' => basename($image_uploaded_path),
    		'image_url'=>Storage::disk('public')->url($image_uploaded_path),'mimeType'=>$image->getClientMimeType());*/
    		$response=['message'=>'File Uploaded Sucessfully','status'=>'1','responsedata'=>$path];
    			return response()->json($response);
    	}
    	else
    	{
    		$response=['message'=>'Method is not allowed','status'=>'0'];
    		return response()->json($response);
    	}
    }
    public function UploadImageURL(Request $request)
    {
    	if ($request->isMethod('POST')) {
    		# code...
    		
    		$uploadFolder='apiForFlutterUrl';
    		$image=base64_decode($request->image);
    		$file=file_get_contents($image);
    		dd($file);
    		$image_uploaded_path=file_put_contents($uploadFolder, $image);
    		$path=URL::asset('storage').'/'.$image_uploaded_path;
    		//dd($path);
    		/*$uplodedImageResponse=array('image_name' => basename($image_uploaded_path),
    		'image_url'=>Storage::disk('public')->url($image_uploaded_path),'mimeType'=>$image->getClientMimeType());*/
    		$response=['message'=>'File Uploaded Sucessfully','status'=>'1','responsedata'=>$path];
    			return response()->json($response);
    	}
    	else
    	{
    		$response=['message'=>'Method is not allowed','status'=>'0'];
    		return response()->json($response);
    	}
    }
}
