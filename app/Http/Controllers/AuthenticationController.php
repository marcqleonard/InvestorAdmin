<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    //
    public function login() {
        return view('authentication.login');
    }

    public function logout(Request $request) {
        $request->session()->forget('accessToken');
        $request->session()->forget('expirationTimestamp');

        $request->session()->flush();

        return redirect()->route('authentication.login')->with('status', 'You are now logged out');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]); // back to form if validation fails

        // payload for api call
        $payload = \GuzzleHttp\json_encode([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://investor-api.herokuapp.com/api/1.0/token',
                [
                    'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                    'body'    => $payload
                ]
            );
        } catch(\Exception $e) {
            $message = ["Authentication failed. Email or password may be incorrect."];
            return redirect()->back()->withInput()->withErrors(['errors' => $message]);
        }

        // parse response body
        $decoded_body = json_decode($response->getBody());
        $accessToken = $decoded_body->accessToken;

        $explodedToken = explode('.', $accessToken);
        $decoded = json_decode(base64_decode($explodedToken[1]));
        $userPermission = $decoded->aud;

        if($userPermission != "Administrator")
        {
            $message = ["You do not have Administrator privilege."];
            return redirect()->back()->withInput()->withErrors(['errors' => $message]);
        }

        $tokenLifetime = $decoded_body->expires;
        $expirationTimestamp = time() + $tokenLifetime;

        // store token in session
        session(['accessToken' => $accessToken]);
        session(['expirationTimestamp' => $expirationTimestamp]);

        // redirect to dashboard is successful
        return redirect()->route('users.index');
    }
}
