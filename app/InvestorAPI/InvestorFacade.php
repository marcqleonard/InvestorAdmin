<?php
namespace App\InvestorAPI\Facade;

use GuzzleHttp;
use Illuminate\Http\Response;

class InvestorFacade
{
    private $API_URL = "https://investor-api.herokuapp.com/api/1.0/";

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

    // check token response is valid
    private function validateToken($json) {
        try {
            $accessToken = $json->accessToken;
            $explodedToken = explode('.', $accessToken);
            $decoded = json_decode(base64_decode($explodedToken[1]));
            $userPermission = $decoded->aud;

            if($userPermission != "Administrator")
            {
                return False;
            }

            return True;
        }
        catch(\Exception $e) {
            return False;
        }
    }

    // get token and return null if fail
    public function getToken($email, $password) {
        $url = $this->API_URL . "token";

        $payload = json_encode([
            'email' => $email,
            'password' => $password
        ]);

        try {
            $response = $this->client->post($url,
                [
                    'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                    'body'    => $payload
                ]
            );

            $response_body = json_decode($response->getBody());
            if(!$this->validateToken($response_body)) {
                return null;
            }

            return json_decode($response->getBody());
        }
        catch(\Exception $e) {
            return null;
        }
    }

    // get all users with paging
    public function getUsers($pageSize, $pageNumber)
    {
        $url = $this->API_URL . "admin/users";
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

    // get user by id
    public function getUser($userId)
    {
        try {
            $url = $this->API_URL . "admin/users/" . $userId;
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
        $url = $this->API_URL . "admin/users/" . $userId;

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

    // get account by user id and account id
    public function getAccount($userId, $accountId)
    {
        $url = $this->API_URL . "admin/users/" . $userId . "/accounts/" . $accountId;

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

    // get transactions by user id and account id
    public function getTransactions($userId, $accountId)
    {
        $url = $this->API_URL . "admin/users/" . $userId . "/accounts/" . $accountId . "/transactions";

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

    // reset account by user id and account id
    public function resetAccount($id, $accountId)
    {
        $url = $this->API_URL . "admin/users/" . $id . "/accounts/" . $accountId;

        try {
            $response = $this->client->put($url,
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

    // update user details (name, email, level)
    public function updateUser($userId, $displayName, $email, $level)
    {
        $url = $this->API_URL . "admin/users/" . $userId;

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

    // get buy brokerage fee
    public function getBuyBrokerageFee()
    {
        $url = $this->API_URL . "admin/commissions/buy";

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

    // get sell brokerage fee
    public function getSellBrokerageFee()
    {
        $url = $this->API_URL . "admin/commissions/sell";

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

    // update buy brokerage fee
    public function updateBuyFee($buyFixedBrackets, $buyPercentageBrackets)
    {
        $url = $this->API_URL . "admin/commissions/buy";

        $payload = json_encode([
            "fixed" => $buyFixedBrackets,
            "percentage" => $buyPercentageBrackets
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
            return new Response($e);
        }
    }

    // update sell brokerage fee
    public function updateSellFee($sellFixedBrackets, $sellPercentageBrackets)
    {
        $url = $this->API_URL . "admin/commissions/sell";

        $payload = json_encode([
            "fixed" => $sellFixedBrackets,
            "percentage" => $sellPercentageBrackets
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
            return new Response($e);
        }
    }
}