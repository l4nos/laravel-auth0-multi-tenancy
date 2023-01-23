<?php

namespace Lanos\Auth0MultiManagement\Modules;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Lanos\Auth0MultiManagement\ManagementRequest;

class Organization
{

    /**
     * Query Params are per APi Documentation - E.G. Pagination
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function get($query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations', $query_params, null);

    }

    /**
     * @param $id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function select($id){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/' . $id);

    }

    /**
     * @param $id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function enabledConnections($id, $query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/' . $id . '/enabled_connections', $query_params);

    }

    /**
     * @param $id
     * @param $connection_id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function getConnection($id, $connection_id){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/' . $id . '/enabled_connections/' . $connection_id);

    }

    /**
     * @param $id
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function addConnection($id, $data){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations/' . $id . '/enabled_connections', null, $data);

    }

    /**
     * @param $id
     * @param $connection_id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteConnection($id, $connection_id){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/organizations/' . $id . '/enabled_connections/' . $connection_id);

    }

    /**
     * @param $id
     * @param $connection_id
     * @param array $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function updateConnection($id, $connection_id, array $data){

        $request = new ManagementRequest();
        return $request->request('PATCH', '/organizations/' . $id . '/enabled_connections/' . $connection_id, null, $data);

    }

    /**
     * @param $id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function invitations($id, $query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/' . $id . '/invitations', $query_params);

    }

    /**
     * @param $id
     * @param $invitation_id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function getInvitation($id, $invitation_id){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/' . $id . '/invitations/' . $invitation_id);

    }

    /**
     * @param $id
     * @param $invitation_id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteInvitation($id, $invitation_id){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/organizations/' . $id . '/invitations/' . $invitation_id);

    }

    /**
     * @param $id
     * @param $invitation_data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function createInvitation($id, $invitation_data){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations/' . $id . '/invitations', null, $invitation_data);

    }

    /**
     * @param $id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function members($id, $query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/' . $id . '/members', $query_params);

    }

    /**
     * @param $id
     * @param array $members // ARRAY OF USER IDS
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function deleteMembers($id, array $members = []){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/organizations/' . $id . '/members', null, [
            "members" => $members
        ]);

    }

    /**
     * @param $id
     * @param array $members // ARRAY OF USER IDS
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function addMembers($id, array $members = []){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations/' . $id . '/members', null, [
            "members" => $members
        ]);

    }

    /**
     * @param $id
     * @param $member_id
     * @param $query_params
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function getMemberRoles($id, $member_id, $query_params){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations/' . $id . '/members/' . $member_id . '/roles', $query_params);

    }

    /**
     * @param $id
     * @param $member_id
     * @param $roles // ARRAY OF ROLE IDS
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function revokeMemberRoles($id, $member_id, $roles){

        $request = new ManagementRequest();
        return $request->request('DELETE', '/organizations/' . $id . '/members/' . $member_id . '/roles', null, [
            "roles" => $roles
        ]);

    }

    /**
     * @param $id
     * @param $member_id
     * @param $roles // ARRAY OF ROLE IDS
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function assignMemberRole($id, $member_id, $roles){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations/' . $id . '/members/' . $member_id . '/roles', null, [
            "roles" => $roles
        ]);

    }

    /**
     * @param $name
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function selectByName($name){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/names/' . $name);

    }

    /**
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function create($data){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations', null, $data);

    }

    /**
     * @param $id
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function delete($id){

       $request = new ManagementRequest();
       return $request->request('POST', '/organizations/' . $id);

    }

    /**
     * @param $id
     * @param $data
     * @return Exception|mixed
     * @throws GuzzleException
     */
    public static function update($id, $data){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations/' . $id, null, $data);

    }

}