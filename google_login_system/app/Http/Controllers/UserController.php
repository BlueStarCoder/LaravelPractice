<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
   
        public function googleLogin(Request $request)  {
            $google_redirect_url = route('glogin');
            $gClient = new \Google_Client();
            $gClient->setApplicationName('apilaravel');
            $gClient->setClientId('607614934655-a8r3tifa2h7j77t2ar55uhmtvoiq6a8f.apps.googleusercontent.com');
            $gClient->setClientSecret('SoXkCtpsHamuQCLFPrYuJ15g');
            $gClient->setRedirectUri($google_redirect_url);
            $gClient->setDeveloperKey('AIzaSyDnqwGSvOR1Ainmx9Wd344zt9oP0uyQ6m8');
            $gClient->setScopes(array(
                'https://www.googleapis.com/auth/plus.me',
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile',
            ));
            $google_oauthV2 = new \Google_Service_Oauth2($gClient);
            if ($request->get('code')){
                $gClient->authenticate($request->get('code'));
                $request->session()->put('token', $gClient->getAccessToken());
            }
            if ($request->session()->get('token'))
            {
                $gClient->setAccessToken($request->session()->get('token'));
            }
            if ($gClient->getAccessToken())
            {
                //For logged in user, get details from google using access token
                $guser = $google_oauthV2->userinfo->get();  
                   
                    $request->session()->put('name', $guser['name']);
                    if ($user = User::where('email',$guser['email'])->first())
                    {
                    	// Logging infromation in laravel.log
                    	// \Log::info("This is the information : " . $user);
                    	// \Log::info(Session::get('key'));
                        //logged your user via auth login
                    } else {
                    	$uname = $guser->familyName;
                    	$ugname = $guser->givenName;
                    	$uname = $guser->name;
                    	$ugen = $guser->gender;
                    	$upic = $guser->picture;
                    	$uemail = $guser->email;
                    	$timenow = Carbon::now();
                    	\DB::table('users')->insert(['name' => $uname, 'email'=> $uemail, 'password'=> '', 'created_at' => $timenow, 'updated_at' => $timenow]);
                        //register your user with response data
                    }               
             return redirect()->route('user.glist');          
            } else
            {
                //For Guest user, get google login url
                $authUrl = $gClient->createAuthUrl();
                return redirect()->to($authUrl);
            }
        }

        public function listGoogleUser(Request $request){
          $users = User::orderBy('id','DESC')->paginate(5);
         return view('users.list',compact('users'))->with('i', ($request->input('page', 1) - 1) * 5);;
        }

        public function glogout() {
            \Session::flush();
            // Session::forget($sessionkey);
            // $request->session()->token()->revoke();
            \Auth::logout();
            return redirect('google-user');
            $gClient->setToken(null);
            $google_oauthV2->setToken(null);
            session(['auto' => null, 'token' => null]);
            \Log::info(session());
            $gClient->revokeToken();
            $google_oauthV2->revokeToken();
            //  if (\Auth::check()) {
            //   \Session::flush();
            //   // \Auth::user()->AauthAccessToken()->delete();
            //   // \Request::session()->token()-revoke();
            //   // $request->user()->token()-revoke();
            //   // Session::forget($sessionkey);
            //   \Auth::logout();
            //   return redirect('google-user');
            //  }
        }
}
