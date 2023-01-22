<?php

namespace Lanos\Auth0MultiManagement;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class ManagementRequest
{

    private $client_id;
    private $client_secret;
    private $audience;
    private $base_url;
    private $token_url;
    private $api_version;
    private $access_token;

    public function __construct(){
        $this->client_id = config('authz.credentials.client_Id');
        $this->client_secret = config('authz.credentials.client_secret');
        $this->api_version = config('authz.version');
        $this->base_url = config('authz.domain') . '/api/' . $this->api_version;
        $this->token_url = config('authz.domain') . '/outh/token';
        $this->audience = config('authz.audience');
    }

    /**
     * First checks for the access token, retrieves it if needed...
     * Then constructs the HTTP request using Guzzle
     * @param $method
     * @param $path
     * @param $query_params
     * @param $json
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function request($method, $path, $query_params = null, $json = null){

        // CHECK TOKEN FIRST

        if(!isset($this->access_token)){
            $tokenRequest = $this->retrieveToken();
            if(isset($tokenRequest->access_token)){
                $this->access_token = $tokenRequest->access_token;
            }else{
                Log::error('Unable to retrieve access token from Auth0');
                throw new \Exception('Unable to retrieve access token from Auth0', 500);
            }
        }

        $url = $this->base_url . $path;
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->access_token,
        ];

        $options = [
            RequestOptions::QUERY => $query_params,
            RequestOptions::HEADERS => $headers,
            RequestOptions::JSON => $json
        ];

        $client = new Client($options);

        try{

            $response = $client->request($method, $url);
            return json_decode($response->getBody()->getContents());

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return $exception;
        }

    }

    /**
     * Function for retrieving management access token from Auth0
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function retrieveToken(){

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $options = [
            RequestOptions::FORM_PARAMS => [
                "grant_type" => "client_credentials",
                "client_id" => $this->client_id,
                "client_secret" => $this->client_secret,
                "audience" => $this->audience
            ]
        ];

        $client = new Client($options);

        try{
            $response = $client->request('POST', $this->token_url);
            return json_decode($response->getBody()->getContents());
        }catch (GuzzleException $exception){
            Log::error($exception->getMessage());
            return $exception;
        }

    }

}