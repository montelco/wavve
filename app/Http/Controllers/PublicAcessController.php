<?php

namespace Wavvve\Http\Controllers;
use Illuminate\Http\Request;
use Wavvve\Http\Requests;
use Wavvve\Pass;

class PublicAcessController extends Controller
{
    public function pubAccess($uuid, Pass $pass){
    	$currentTime = date("Y-m-d H:i:s");
        $customerPass = Pass::where('uuid', $uuid)->first();
        if($customerPass === NULL){
        	return abort('500');
        } else{
	        if($customerPass->published <= $currentTime){
		        switch ($customerPass->template_number){
		        	case 1:
		        		return view('pub.pass_pub_template_one')->with('pass', $customerPass);
		        		break;
		    		case 2:
		    			return view('pub.pass_pub_template_two')->with('pass', $customerPass);
		    			break;
					case 3:
						return view('pub.pass_pub_template_three')->with('pass', $customerPass);
						break;
		        }
	        } else{
	        	return abort('404');
	        }
    	}
    }

    public function caching(){
    	//Caching JSON output to run for service workers.
    }
}
