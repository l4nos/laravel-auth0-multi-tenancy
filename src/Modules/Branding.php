<?php

namespace Lanos\Auth0MultiManagement\Modules;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Lanos\Auth0MultiManagement\ManagementRequest;

class Branding
{

    /**
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function get(){

        $request = new ManagementRequest();
        return $request->request('GET', '/branding', null, null);

    }

    /**
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function getDefaultTheme(){

        $request = new ManagementRequest();
        return $request->request('GET', '/branding/themes/default', null, null);

    }


    /**
     * @param $theme_id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteTheme($theme_id){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/branding/themes/' . $theme_id, null, null);

    }


    /**
     * @param $theme_id
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function updateTheme($theme_id, $data){

        $request = new ManagementRequest();
        return $request->request('PATCH', '/branding/themes/' . $theme_id, null, $data);

    }

    /**
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function createTheme($data){

        $request = new ManagementRequest();
        return $request->request('POST', '/branding/themes', null, $data);

    }

    /**
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function getLoginTemplate(){

        $request = new ManagementRequest();
        return $request->request('GET', '/branding/templates/universal-login', null, null);

    }

    /**
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteLoginTemplate(){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/branding/templates/universal-login', null, null);

    }

    /**
     * @param $html
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function updateLoginTemplate($html){

        $request = new ManagementRequest();
        return $request->request('PUT', '/branding/templates/universal-login', null, [
            "template" => $html
        ]);

    }

    /**
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function update($data){

        $request = new ManagementRequest();
        return $request->request('POST', '/branding', null, $data);

    }


}