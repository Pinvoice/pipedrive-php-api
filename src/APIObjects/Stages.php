<?php

namespace Pinvoice\Pipedrive\APIObjects;

use Pinvoice\Pipedrive\Exceptions\ValidatorException;

class Stages extends APIObject
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
     * Get all stages.
     *
     * HTTP GET /stages
     *
     * @return array Returns data about all stages
     */
    public function getStages()
    {
        $data = $this->http->get('/stages');
        return $this->safeReturn($data);
    }

    /**
     * Get stage.
     *
     * HTTP GET /stages/1
     *
     * @param int $id ID of stage to get
     * @return array Returns data about a specific stage
     */
    public function getStage($id)
    {
        $this->validateDigit($id);
        $data = $this->http->get('/stages/' . $id);
        
        return $this->safeReturn($data);
    }

    /**
     * Get all stages for pipeline.
     *
     * HTTP GET /stages/?pipeline_id=1
     *
     * @param int $id ID of the pipeline to fetch stages for
     * @throws \Exception if $pipeline_id isn't numeric.
     * @return array Returns stages for provided pipeline
     */
    public function getStagesByPipelineId($id)
    {
        $this->validateDigit($id);
        $data = $this->http->getWithParams('/stages?pipeline_id=' . $id);

        return $this->safeReturn($data);
    }

}
