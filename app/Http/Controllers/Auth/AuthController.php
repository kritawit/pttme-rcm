<?php namespace App\Http\Controllers\Auth;



use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Auth;
use Session;
class AuthController extends Controller {

 	/**
     * the model instance
     * @var User
     */
    protected $member;
    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;

    public function __construct(Guard $auth, Member $member)
    {
        $this->member = $member;
        $this->auth = $auth;

        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function getRegister()
    {
        return view('register');
    }

     /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest  $request
     * @return Response
     */
    public function postRegister(RegisterRequest $request)
    {
        //code for registering a user goes here.
        $this->member->email = $request->email;
        $this->member->name = $request->name;
        $this->member->username = $request->username;
		$this->member->password = bcrypt($request->password);
		$this->member->save();
        Auth::attempt($request->only('username', 'password'),true);
        return redirect('/dash-board');
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->only('username', 'password'),$request->remember))
        {
            return redirect('/project');
        }

        return redirect('/login')->withErrors([
            'email' => 'The credentials you entered did not match our records. Try again?',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
