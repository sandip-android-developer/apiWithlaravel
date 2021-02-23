<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    //
    public function basicMail()
    {
    	$data=array('name'=>'sandip kumar');
    	Mail::send('mail',['data'=>$data],function($message)
    	{
    		$message->to('sandipcool.588@gmail.com','Laravel')->subject('Laravel Basic testing mail');
    		$message->from(env('MAIL_USERNAME'),'Sandip');
    		
    	});

    }
}
