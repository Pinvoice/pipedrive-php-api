<?php

namespace Pinvoice\Pipedrive;

class Stages extends APIObject
{
    /**
     * Get all stages.
     *
     * HTTP GET /stages
     *
     * @return array Returns data about all stages
     */
    public static function getStages()
    {
        $data = HTTP::get('/stages');
        return API::safe_return($data);
    }

    /**
     * Get stage.
     *
     * HTTP GET /stages/1
     *
     * @param int $stage_id ID of stage to get
     * @return array Returns data about a specific stage
     */
    public static function getStage($stage_id)
    {
        $data = HTTP::get('/stages/' . $stage_id);
        return API::safe_return($data);
    }

    /**
     * Get all stages for pipeline.
     *
     * HTTP GET /stages/?pipeline_id=1
     *
     * @param int $pipeline_id ID of the pipeline to fetch stages for
     * @throws \Exception if $pipeline_id isn't numeric.
     * @return array Returns stages for provided pipeline
     */
    public static function getStagesByPipelineId($pipeline_id)
    {
        if (is_numeric($pipeline_id)) {
            $data = HTTP::getWithParams('/stages?pipeline_id=' . $pipeline_id);
        } else {
            throw new \Exception("Param pipeline_id should be numeric");
        }
        return API::safe_return($data);
    }
}

?>
