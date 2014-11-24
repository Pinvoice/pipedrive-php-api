<?php

namespace Pinvoice\Pipedrive\APIObjects;

class Pipelines extends APIObject
{

    /**
     * [__construct description]
     * @param [type] $http [description]
     */
    public function __construct($http)
    {
        parent::__construct($http);
    }

    /**
     * Get Pipelines.
     *
     * HTTP GET /pipelines
     *
     * @return array Array of pipelines
     */
    public function getPipelines()
    {
        $data = $this->http->get('/pipelines');
        return $this->safeReturn($data);
    }

    /**
     * Get Pipeline by ID.
     *
     * HTTP GET /pipelines/{id}
     *
     * @param int $id ID of Pipeline to get
     * @return object Single pipeline
     */
    public function getPipeline($id)
    {

        $this->validateDigit($id);

        $data = $this->http->get('/pipelines/' . $id);
        return $this->safeReturn($data);
    }

    /**
     * Add a new pipeline.
     *
     * @param array $args Array of several possible arguments
     * @return object New pipeline
     */
    public function addPipeline(array $args)
    {
        // TODO: Arguments in doc and validation...
        $data = $this->http->post('/pipelines', $args);
        return $this->safeReturn($data);
    }

}
