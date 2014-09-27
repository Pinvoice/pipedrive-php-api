<?php
namespace Pinvoice\Pipedrive;

class Stages
{
    
    /**
     * Get all stages
     *
     * @return array Returns data about all stages
     */
    public static function getStages() {
        
        // GET /stages
        $data = API::http_get('/stages');
        
        return API::safe_return($data);
    }
    
    /**
     * Get all stages for pipeline
     *
     * @param pipeline_id int ID of the pipeline to fetch stages for. If omitted, stages for all pipelines will be fetched.
     * @return array Returns stages for proviced pipeline
     */
    
    public static function getStagesByPipelineId($pipeline_id) {
        
        // GET /stages
        $data = API::http_get_with_params('/stages?pipeline_id=' . $pipeline_id);
        
        return API::safe_return($data);
    }
}
?>