<?php

namespace Pinvoice\Pipedrive;

class Pipelines extends APIObject
{
    /**
     * Get Pipelines.
     *
     * HTTP GET /pipelines
     *
     * @return array Array of pipelines
     */
    public static function getPipelines()
    {
        $data = HTTP::get('/pipelines');
        return self::safeReturn($data);
    }

    /**
     * Get Pipeline by ID.
     *
     * HTTP GET /pipelines/{id}
     *
     * @param int $id ID of Pipeline to get
     * @return object Single pipeline
     */
    public static function getPipeline($id)
    {
        $data = HTTP::get('/pipelines/' . $id);
        return self::safeReturn($data);
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
        $data = HTTP::post('/pipelines', $args);
        return self::safeReturn($data);
    }

}
