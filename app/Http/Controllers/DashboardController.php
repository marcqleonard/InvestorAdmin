<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request, $status=null)
    {
        if($request->has('pageSize') && $request->has('pageNumber')) {
            $pageSize = $request->input('pageSize');
            $pageNumber = $request->input('pageNumber');
        }
        else {
            $pageSize = 5;
            $pageNumber = 1;
        }

        if($request->has('status')) {
            $status = $request->input('status');
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

        return view('dashboard.index')->with(compact('users'))->with('pageNumber', $pageNumber)->with('pageSize', $pageSize)->with('totalPageCount', $totalPageCount)->with('status', $status);
    }

    public function delete(Request $request)
    {
        if($request->has('userId')) {
            $userId = $request->input('userId');
        }

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
        $status = "User successfully deleted";
        return redirect()->route('dashboard', ['status' => $status]);
    }
}
