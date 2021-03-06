<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

	public function __construct(){
		$this->middleware('guest', [ 'except' => 'logout' ]);
	}

    public function googleLogin(Request $request){
    	$gClient= new \Google_Client();
    	$gClient->setApplicationName('PQRSF - Universidad del Cauca');
        $gClient->setClientId('706330254364-a4mc6no6tjikib8a80gvdfpns357dur7.apps.googleusercontent.com');
        $gClient->setClientSecret('ofNaryan-9mMjblr8nsUVUU-');
        $gClient->setRedirectUri('http://localhost:8000/login');

        //$gClient->setDeveloperKey(config('services.google.api_key'));

        $gClient->setScopes(array(
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ));

        $google_oauthV2 = new \Google_Service_Oauth2($gClient);
        
        if($request->session()->get('token')){
	            $gClient->setAccessToken($request->session()->get('token'));
	    }
        
        else{
        	if($request->get('code')){
	            $gClient->authenticate($request->get('code'));
	            $request->session()->put('token', $gClient->getAccessToken());
	        }	
        }       

        if($gClient->getAccessToken()){
            
            //For logged in user, get details from google using access token
            $gUser = $google_oauthV2->userinfo->get();                       
            $user=User::find($gUser['email']);
            if ($user){
                
                if(Auth::loginUsingId($user->id)){                	
                	return redirect('/admin');
                }
                else{
                	return "houston we have a problem";
                }                              
            }
            else{
                return 'No estas registrado en el sistema';
            }               
         
        } 
        else{
            //For Guest user, get google login url
            $authUrl = $gClient->createAuthUrl();
            return redirect()->to($authUrl);
        }       
    }

    public function logout(Request $request){
    	Auth::logout();
    	$request->session()->flush();
    	return redirect()->guest('https://accounts.google.com/logout');
    }
}
