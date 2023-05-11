<?php

namespace Lanos\Auth0MultiManagement\Modules;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Lanos\Auth0MultiManagement\ManagementRequest;

class User
{

    /**
     * Query Params are per APi Documentation - E.G. Pagination
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function get($query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/users', $query_params);

    }

    /**
     * @param $id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function select($id){

        $request = new ManagementRequest();
        return $request->request('GET', '/users/' . $id);

    }

    /**
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function create($data){

        $request = new ManagementRequest();
        return $request->request('POST', '/users', null, $data);

    }

    /**
     * @param $id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function delete($id){

        $request = new ManagementRequest();
        return $request->request('POST', '/users/' . $id);

    }

    /**
     * @param $id
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function update($id, $data){

        $request = new ManagementRequest();
        return $request->request('PATCH', '/users/' . $id, null, $data);

    }

    /**
     * @param $id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function mfaEnrollments($id, $query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/users/' . $id . '/enrollments', $query_params);

    }

    /**
     * @param $id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function organizations($id, $query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/users/' . $id . '/organizations', $query_params);

    }

    /**
     * @param $id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function logs($id, $query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/users/' . $id . '/logs', $query_params);

    }

    /**
     * @param $id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function permissions($id, $query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/users/' . $id . '/permissions', $query_params);

    }

    /**
     * @param $id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function roles($id, $query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/users/' . $id . '/roles', $query_params);

    }

    /**
     * @param $id
     * @param $user_id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function authenticationMethods($id){

        $request = new ManagementRequest();
        return $request->request('GET', '/users/' . $id . '/authentication-methods');

    }

    /**
     * @param $id
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function addAuthenticationMethod($id, $data){

        $request = new ManagementRequest();
        return $request->request('POST', '/users/' . $id . '/authentication-methods', null, $data);

    }

    /**
     * @param $id
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function replaceAuthenticationMethods($id, $data){

        $request = new ManagementRequest();
        return $request->request('PUT', '/users/' . $id . '/authentication-methods', null, $data);

    }

    /**
     * @param $id
     * @param $method_id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteAuthenticationMethod($id, $method_id){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/users/' . $id . '/authentication-methods/' . $method_id);

    }

    /**
     * @param $id
     * @param $method_id
     * @param array $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function updateAuthenticationMethod($id, $method_id, array $data){

        $request = new ManagementRequest();
        return $request->request('PATCH', '/users/' . $id . '/authentication-methods/' . $method_id, null, $data);

    }

    /**
     * @param $id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteAuthenticators($id){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/users/' . $id . '/authenticators');

    }

    /**
     * @param $id
     * @param array $roles
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteRoles($id, array $roles){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/users/' . $id . '/roles', null, [
            "roles" => $roles
        ]);

    }

    /**
     * @param $id
     * @param array $roles
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function assignRoles($id, array $roles){

        $request = new ManagementRequest();
        return $request->request('POST', '/users/' . $id . '/roles', null, [
            "roles" => $roles
        ]);

    }

    /**
     * @param $id
     * @param array $roles
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deletePermissions($id, array $roles){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/users/' . $id . '/permissions', null, [
            "roles" => $roles
        ]);

    }

    /**
     * @param $id
     * @param array $roles
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function assignPermissions($id, array $roles){

        $request = new ManagementRequest();
        return $request->request('POST', '/users/' . $id . '/permissions', null, [
            "roles" => $roles
        ]);

    }

    /**
     * @param $id
     * @param $provider
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteMfaProvider($id, $provider){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/users/' . $id . '/multifactor/' . $provider);

    }

    /**
     * @param $id
     * @param array $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function linkIdentity($id, array $data){

        $request = new ManagementRequest();
        return $request->request('POST', '/users/' . $id . '/identities', null, $data);

    }

    /**
     * @param $id
     * @param $provider
     * @param $provider_user_id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function unlinkIdentity($id, $provider, $provider_user_id){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/users/' . $id . '/identities/' . $provider . '/' . $provider_user_id);

    }

    /**
     * @param $id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function generateMFACode($id){

        $request = new ManagementRequest();
        return $request->request('POST', '/users/' . $id . '/recovery-code-regeneration');

    }

    /**
     * @param $id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function forgetMFADevices($id){

        $request = new ManagementRequest();
        return $request->request('POST', '/users/' . $id . '/multifactor/actions/invalidate-remember-browser');

    }




}