<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Exception;

class DashboardController extends Controller
{
    //
    public function index()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://investor-api.herokuapp.com/api/1.0/admin/users',
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
        $users = $decoded_body->items;

        return view('dashboard.index')->with(compact('users'));
    }
}
