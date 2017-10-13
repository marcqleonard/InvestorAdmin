<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Exception;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->has('pageSize') && $request->has('pageNumber')) {
            $pageSize = $request->input('pageSize');
            $pageNumber = $request->input('pageNumber');
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

        return view('dashboard.index')->with(compact('users'))->with('pageNumber', $pageNumber)->with('pageSize', $pageSize)->with('totalPageCount', $totalPageCount);
    }
}
