<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    protected $username = 'username';
    
    protected $maxLoginAttempts = 2;
    protected $lockoutTime = 300;
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    //// El Throttleslogins es una clase que me permite bloquear despues de 5 o instentos 
    //// fallidos a un usuario en caso de que este tratando de ser hackeada la cuenta
    //// en este mismo arcivo se puede configura la candida de intentos al igual que el
    //// tiempo que estara bloqueado el usuario en las funciones maxLoginAttempts() y
    //// lockoutTime()
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    protected $redirectPath = 'login';
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getConfirmation','getLogout']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:25',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
        protected function create(array $data)
        {
            $user= new User([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]);

            $user->role='user';
            $user->registration_token = str_random(40);
            $user->save();

            $url = route('confirmation',['token'=>$user->registration_token]);

            Mail::send('emails/registration',  compact('user','url'), function($m) use($user){
                $m->to($user->email, $user->name)->subject('Activa tu cuenta');
            });

            return $user;
            /*return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'active' =>$data['active'],
                'registration_token' => str_random(40)
            ]);*/
        }
        /**
         * Get the failed login message
         * 
         * @return string
        */
        protected function getFailedLoginMessage()
        {
            return trans('passwords.credentials_invalid');
        }

        /**
         * Get the needed authorization credentials from the request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array
         */
        protected function getCredentials(Request $request)
        {      
            return[
                'username' => $request->get('username'),
                'password' => $request->get('password')
            ]; 
        }

        /**
         * Handle a registration request for the application.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function postRegister(Request $request)
        {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            $user =$this->create($request->all());
            return redirect($this->redirectPath())->with('alert','Por favor confirma tu registro en tu email: '.$user->email);
            //return redirect()->$url->with('alert','Por favor confirma tu registro en tu email: '.$user->email);
            //return redirect()->route('login')
            //       ->with('alert','Por favor confirma tu registro en tu email: '.$user->email);
        }

        public function getConfirmation($token)
        {
            $user = User::where('registration_token',$token)->firstOrFail();
            $user -> registration_token=null;
            $user -> active=1;
            $user -> save();

            return redirect()->route('home')
                    ->with('alert','¡ Tu E-mail ya fue confirmado!');
        }
    
}
