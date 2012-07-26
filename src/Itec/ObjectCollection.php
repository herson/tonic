<?php

namespace Itec;

use Tonic\Resource,
    Tonic\Response,
    Tonic\Request;

/**
 * @uri /objects
 */
class ObjectCollection extends Resource {

    /**
     * @method GET
     * @provides application/json
     */
     function listAll() {
        $ds = $this->container['dataStore'];
        return json_encode($ds->fetchAll());
    }

    /**
     * @method POST
     * @accepts application/json
     */
    function add() {
        $ds = $this->container['dataStore'];
        $data = json_decode($this->request->data);
        $ds->add($data);
        return new Response(Response::CREATED);
    }
}