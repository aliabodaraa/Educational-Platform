<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;
//use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    use RememberMeExpiration;

    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
           if(!Auth::validate($credentials)):
               //dd(99);
               //abort(403);
               return redirect()->to('login')
                   ->withErrors(trans('auth.failed'));
           endif;
           //dd(100);
         $user = Auth::getProvider()->retrieveByCredentials($credentials);
         Auth::login($user, $request->get('remember'));

         if($request->get('remember')):
             $this->setRememberMeExpiration($user);
         endif;

         return $this->authenticated($request, $user);
        //dd($credentials);
            // if(isset($credentials['email'])){
            //     $email=$credentials['email'];
            //     $request->validate(["email"=>"required|email|exists:users,email","password"=>"required"]);
            //     $cerds = $request->only('email','password');
            // }elseif(isset($credentials['username'])){
            //     $request->validate(["username"=>"required|exists:users,username","password"=>"required"]);
            //     $cerds = $request->only('username','password');
            //  }
            //  dd(Auth::attempt($cerds));
            //   if( Auth::attempt($cerds) ){
            //       return redirect()->route('/')->with('success','correct credentails');
            //   }else{
            //       return redirect()->back()->with('fail','incorrect credentails Because This Email Exists in Users Table but does not correspond with entered password');//go to the same page [dashboard.user.register]
            //   }

    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
