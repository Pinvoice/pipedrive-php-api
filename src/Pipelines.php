<?php

namespace Pinvoice\Pipedrive;

class Pipelines extends APIObject
{
    /**
     * Get Pipelines.
     *
     * @return array Array of pipelines
     */
    public static function getPipelines()
    {

        // GET /pipelines
        $data = MyHTTP::get('/pipelines');

        return API::safe_return($data);
    }

    /**
     * Get Pipeline by ID.
     *
     * @param int $id ID of Pipeline to get
     * @return object Single pipeline
     */
    public static function getPipeline($id)
    {

        // GET /pipelines/{id}
        $data = MyHTTP::get('/pipelines/' . $id);

        return API::safe_return($data);
    }

    /**
     * Add a new pipeline.
     *
     * @param array $args Array of several possible arguments
     * @return object New pipeline
     */
    public static function addPipeline(array $args)
    {

        // TODO: Arguments in doc and validation...

        $data = MyHTTP::post('/pipelines', $args);

        return API::safe_return($data);
    }

}

?>