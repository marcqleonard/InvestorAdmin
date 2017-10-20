<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    // show all users
    public function index(Request $request)
    {
        if($request->has('page') && $request->has('size')) {
            $pageSize = $request->input('size');
            $pageNumber = $request->input('page');
        }
        else {
            $pageSize = 5;
            $pageNumber = 1;
        }

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://investor-api.herokuapp.com/api/1.0/admin/users',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . session('accessToken'),
                        'Accept' => 'application/json'
                    ],
                    'query' => ['pageSize' => $pageSize, 'pageNumber' => $pageNumber]
                ]
            );
        } catch(\Exception $e) {
            //throw new \Exception("Failure to get data from API.");
            echo "Failure to get data";
        }

        // parse response body
        $decoded_body = json_decode($response->getBody());
        $users = $decoded_body->items;
        $pageNumber = $decoded_body->pageNumber;
        $pageSize = $decoded_body->pageSize;
        $totalPageCount = $decoded_body->totalPageCount;

        return view('users.index')->with(compact('users'))->with('pageNumber', $pageNumber)->with('pageSize', $pageSize)->with('totalPageCount', $totalPageCount);
    }

    // delete user by Id
    public function destroy(Request $request, $id)
    {
        $userId = $id;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->delete('https://investor-api.herokuapp.com/api/1.0/admin/users/' . $userId,
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . session('accessToken'),
                        'Accept' => 'application/json'
                    ]
                ]
            );
        } catch(\Exception $e) {
            echo "Failure to get data";
        }

        return redirect()->route('users.index')->with('status', 'User deleted! ' . $userId);
    }

    public function show(Request $request, $id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://investor-api.herokuapp.com/api/1.0/admin/users/' . $id,
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . session('accessToken'),
                        'Accept' => 'application/json'
                    ]
                ]
            );
        } catch(\Exception $e) {
            //throw new \Exception("Failure to get data from API.");
            echo "Failure to get data";
        }

        // parse response body
        $decoded_body = json_decode($response->getBody());
        $user = $decoded_body;

        return view('users.show')->with(compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'name' => 'required|regex:/^[^~`^$#@%!\'*\(\)<>=.;:]+$/u|min:5|max:30',
            'level' => 'required|in:Investor,Administrator'
        ]); // back to form if validation fails

        $displayName = $request->input('name');
        $email = $request->input('email');
        $level = $request->input('level');

        // payload for api call
        $payload = \GuzzleHttp\json_encode([
            'displayName' => $displayName,
            'email' => $email,
            'level' => $level
        ]);

        $userId = $id;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->put('https://investor-api.herokuapp.com/api/1.0/admin/users/' . $userId,
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . session('accessToken'),
                        'Accept' => 'application/json'
                    ],
                    'body' => $payload
                ]
            );
        } catch(\Exception $e) {
            echo "Failure to get data";
        }

        return redirect()->back()->with('status', 'User updated!');
    }
}
