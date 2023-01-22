<?php

namespace Lanos\Auth0MultiManagement\Modules;

use GuzzleHttp\Exception\GuzzleException;
use Lanos\Auth0MultiManagement\ManagementRequest;

class Organization
{

    /**
     * Query Params are per APi Documentation - E.G. Pagination
     * @param $query_params
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function get($query_params){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations', $query_params, null);

    }

    /**
     * @param $id
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function select($id){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/' . $id);

    }

    /**
     * @param $id
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function members($id){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/' . $id . '/members');

    }

    /**
     * @param $id
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function selectByName($name){

        $request = new ManagementRequest();
        return $request->request('GET', '/organizations/names/' . $name);

    }

    /**
     * @param $data
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function create($data){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations', null, $data);

    }

    /**
     * @param $id
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function delete($id){

       $request = new ManagementRequest();
       return $request->request('POST', '/organizations/' . $id);

    }

    /**
     * @param $id
     * @param $data
     * @return \Exception|mixed
     * @throws GuzzleException
     */
    public function update($id, $data){

        $request = new ManagementRequest();
        return $request->request('POST', '/organizations/' . $id, null, $data);

    }

}