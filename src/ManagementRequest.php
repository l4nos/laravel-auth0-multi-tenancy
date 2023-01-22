<?php

namespace Lanos\Auth0MultiManagement;

use GuzzleHttp\Client;
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

    public function __construct(){
        $this->client_id = config('authz.credentials.client_Id');
        $this->client_secret = config('authz.credentials.client_secret');
        $this->api_version = config('authz.version');
        $this->base_url = config('authz.domain') . '/api/' . $this->api_version;
        $this->token_url = config('authz.domain') . '/outh/token';
        $this->audience = config('authz.audience');
    }

    public function request($method, $path, $query_params = null, $json = null){

        $url = $this->base_url . $path;
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->access_token,
        ];
    }

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
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return $exception;
        }

    }

}