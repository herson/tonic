<?php

namespace Itec;

use Tonic\Resource,
    Tonic\Response,
    Tonic\Request;

/**
 * @uri /objects/:id
 */
class Object extends Resource {

    /**
     * @method GET
     * @provides application/json
     * @return Tonic\Response
     */
    function display() {
        $ds = $this->container['dataStore'];
        var_dump($ds);
        return json_encode($ds->fetch($this->id));
    }

    /**
     * @method PUT
     * @accepts application/json
     * @provides application/json
     */
    function update() {
        $ds = $this->container['dataStore'];
        $data = json_decode($this->request->data);
        $ds->update($this->id, $data);
        return $this->display();
    }

    /**
     * @method DELETE
     */
    function remove() {
        $ds = $this->container['dataStore'];
        $ds->delete($this->id);
        return new Response(Response::NOCONTENT);
    }
}