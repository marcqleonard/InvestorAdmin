<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvestorAPI\Facade\InvestorFacade;

class AuthenticationController extends Controller
{
    // load login form
    public function login() {
        return view('authentication.login');
    }

    // logout user - clear token from session
    public function logout(Request $request) {
        $request->session()->forget('accessToken');
        $request->session()->forget('expirationTimestamp');
        $request->session()->flush();
        return redirect()->route('authentication.login')->with('status', 'You are now logged out');
    }

    // get token from API and store it in session
    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]); // back to form if validation fails

        $email = $request->input('email');
        $password = $request->input('password');

        $facade = new InvestorFacade();
        $response_body = $facade->getToken($email, $password);

        if($response_body == null) {
            $message = ["Authentication failed. Email or password may be incorrect or you do not have administrator access."];
            return redirect()->back()->withInput()->withErrors(['errors' => $message]);
        }

        $accessToken = $response_body->accessToken;
        $tokenLifetime = $response_body->expires;
        $expirationTimestamp = time() + $tokenLifetime;

        // store token in session
        session(['accessToken' => $accessToken]);
        session(['expirationTimestamp' => $expirationTimestamp]);

        // redirect to dashboard is successful
        return redirect()->route('users.index');
    }
}
