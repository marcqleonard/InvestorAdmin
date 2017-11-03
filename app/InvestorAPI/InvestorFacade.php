<?php
namespace App\InvestorAPI\Facade;

use GuzzleHttp;
use Illuminate\Http\Response;

class InvestorFacade
{
    private $API_URL = "https://investor-api.herokuapp.com/api/1.0/admin/";

    private $client;
    private $headers;

    public function __construct() {
        $this->client = new GuzzleHttp\Client();
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . session('accessToken'),
            'Accept' => 'application/json'
        ];
    }

    public function getUsers($pageSize, $pageNumber)
    {
        $url = $this->API_URL . "users";
        try
        {
            $response = $this->client->get($url,
                [
                    'headers' => $this->headers,
                    'query' => ['pageSize' => $pageSize, 'pageNumber' => $pageNumber]
                ]
            );

            return json_decode($response->getBody());
        }
        catch(\Exception $e) {
            return null;
        }
    }

    public function getUser($userId)
    {
        try {
            $url = $this->API_URL . "users/" . $userId;
            $response = $this->client->get($url,
                [
                    'headers' => $this->headers
                ]
            );

            return json_decode($response->getBody());
        }
        catch(\Exception $e) {
            return null;
        }
    }

    // delete user by Id
    public function deleteUser($userId)
    {
        $url = $this->API_URL . "users/" . $userId;

        try {
            $response = $this->client->delete($url,
                [
                    'headers' => $this->headers
                ]
            );

            return True;
        }
        catch(\Exception $e) {
            return False;
        }
    }

    public function getAccount($userId, $accountId)
    {
        $url = $this->API_URL . "users/" . $userId . "/accounts/" . $accountId;

        try {
            $response = $this->client->get($url,
                [
                    'headers' => $this->headers
                ]
            );

            return json_decode($response->getBody());
        }
        catch(\Exception $e) {
            return null;
        }
    }

    public function getTransactions($userId, $accountId)
    {
        $url = $this->API_URL . "users/" . $userId . "/accounts/" . $accountId . "/transactions";

        try {
            $response = $this->client->get($url,
                [
                    'headers' => $this->headers
                ]
            );

            return json_decode($response->getBody());
        }
        catch(\Exception $e) {
            return null;
        }
    }

    public function resetAccount($id, $accountId)
    {
        $url = $this->API_URL . "users/" . $id . "/accounts/" . $accountId;

        try {
            $response = $this->client->put($url,
                [
                    'headers' => $this->headers
                ]
            );
            return json_decode($response->getBody());
        }
        catch(\Exception $e) {
            return null;
        }
    }

    public function updateUser($userId, $displayName, $email, $level)
    {
        $url = $this->API_URL . "users/" . $userId;

        $payload = json_encode([
            'displayName' => $displayName,
            'email' => $email,
            'level' => $level
        ]);

        try {
            $response = $this->client->put($url,
                [
                    'headers' => $this->headers,
                    'body' => $payload
                ]
            );

            return True;
        }
        catch(\Exception $e) {
            return False;
        }
    }
}