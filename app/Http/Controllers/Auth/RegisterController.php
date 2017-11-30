<?php

namespace App\Http\Controllers\Auth;

use App\SocialProvider;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Socialite;

class RegisterController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers;
    
    /**
    * Where to redirect users after registration.
    *
    * @var string
    */
    protected $redirectTo = '/home';
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->middleware('guest');
    }
    
    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:3'
            ]);
    }
        
    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */
    public function create(array $data){
        // $string = substr(md5(uniqid(rand())),0,19);  ##產生隨機字串
        // $string = preg_replace('/\[O|0|I|i|L\]/',rand(1,9),$string);  #排除掉特定字元
        $string = time().substr(md5(uniqid(rand())),0,3);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => "",
            'puid' => $string,
        ]);
    }
    /**
    * Redirect the user to the GitHub authentication page.
    *
    * @return Response
    */
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
            
    /**
    * Obtain the user information from GitHub.
    *
    * @return Response
    */
    public function handleProviderCallback($provider){
        try{
            $socialUser = Socialite::driver($provider)->user();
        }catch(\Exception $e){
            return redirect('/');
        }
        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
        $puidstring = time().substr(md5(uniqid(rand())),0,3);
        if(!$socialProvider){
            //create a new user and provider
            $string = substr(md5(uniqid(rand())),0,8);  ##產生隨機字串
            $string = preg_replace('/\[O|0|I|i|L\]/',rand(1,9),$string);  #排除掉特定字元
            $filename = time() . '.jpg';
            copy($socialUser->getAvatar(),public_path('uploads/avatars/'.$filename));
            $user = User::create([
                'email' => $socialUser->getEmail(),
                'name' => $socialUser->getName(),
                'password' => bcrypt($string),
                'avatar' => $filename,
                'puid' => $puidstring,
            ]);
            $user->socialProviders()->create(
                ['provider_id' => $socialUser->getId(), 'provider' => $provider]
            );
        }else{
            $user = $socialProvider->user;
        }
        auth()->login($user);
        return redirect('/home');
    }     
}
                