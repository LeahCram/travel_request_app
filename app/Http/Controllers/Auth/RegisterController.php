<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
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
    protected $redirectTo = '/';
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        if(isset($data['role']) && $data['role'] === 3) {
            return Validator::make($data, [
                'name'              => ['required', 'string', 'max:255'],
                'username'          => ['required', 'string', 'max:255', 'unique:users'],
                'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'contact_number'    => ['max:50'],
                'password'          => ['required', 'string', 'min:8', 'confirmed'],
                'role'              => ['required', 'in: 3,4'],
            ]);            
        } else {
            return Validator::make($data, [
                'name'              => ['required', 'string', 'max:255'],
                'username'          => ['required', 'string', 'max:255', 'unique:users'],
                'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'contact_number'    => ['max:50'],
                'position'          => ['required', 'string', 'max:255'],
                'official_station'  => ['string', 'max:255'],
                'monthly_salary'    => ['string', 'max:255'],
                'password'          => ['required', 'string', 'min:8', 'confirmed'],
                'role'              => ['required', 'in: 3,4'],
            ]);   
        }

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {

        $roleOpt = Role::whereNotIn('id', [1,2])->get();

        return view('auth.register', compact('roleOpt'));
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'              => $data['name'],
            'username'          => $data['username'],
            'email'             => $data['email'],
            'contact_number'    => @$data['contact_number'],
            'position'          => @$data['position'],
            'official_station'  => @$data['official_station'],
            'monthly_salary'    => isset($data['monthly_salary']) ? str_replace(',', '', $data['monthly_salary']) : NULL,
            'active'            => 0,
            'role_id'           => $data['role'],
            'password'          => Hash::make($data['password']),
        ]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        // Alert Message
        $alertMsg = array(
            'title' => 'Registered!',
            'text'  => 'You are successfully registered. Please wait for the administrator to activate your account.' ,
            'icon'  => 'info',
            'type'  => 'swal',
        );

        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect('/login')->with('alertMsg', $alertMsg);
        // return $request->wantsJson()
        //             ? new Response('', 201)
        //             : redirect($this->redirectPath())->with('alertMsg', $alertMsg);

    }


}
