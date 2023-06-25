<?php

namespace Lanos\Auth0MultiManagement;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ManagementRequest
{

    private $client_id;
    private $client_secret;
    private $audience;
    private $base_url;
    private $token_url;
    private $api_version;

    private $retryCount = 0;
    private $maxRetries = 1;

    public function __construct(){
        $this->client_id = config('authz.credentials.client_Id');
        $this->client_secret = config('authz.credentials.client_secret');
        $this->api_version = config('authz.version');
        $this->base_url = config('authz.domain') . '/api/' . $this->api_version;
        $this->token_url = config('authz.domain') . '/oauth/token';
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

        if(!Cache::has('auth0_mgmt_token')){
            $tokenRequest = $this->retrieveToken();
            if(isset($tokenRequest->access_token)){
                // STORE THE ACCESS TOKEN IN CACHE TO AVOID REPEATED REQUESTS TO TOKEN ENDPOINT
                Cache::put('auth0_mgmt_token', $tokenRequest->access_token, $tokenRequest->expires_in);
            }else{
                Log::error('Unable to retrieve access token from Auth0');
                throw new \Exception('Unable to retrieve access token from Auth0', 500);
            }
        }

        $url = $this->base_url . $path;
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . Cache::get('auth0_mgmt_token'),
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

            if($this->retryCount < $this->maxRetries){
                Cache::delete('auth0_mgmt_token');
                $this->retryCount = $this->retryCount + 1;
                $this->request($method, $path, $query_params, $json);
            }else{
                Log::error($exception->getMessage());
                return $exception;
            }

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