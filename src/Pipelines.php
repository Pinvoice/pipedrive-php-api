<?php
namespace Pinvoice\Pipedrive;

class Pipelines
{
    
    /**
     * Get Pipelines
     *
     * @return array Array of pipelines
     */
    public static function getPipelines() {

        // GET /pipelines
        $data = API::http_get('/pipelines');

        return API::safe_return($data);
    }
    
    /**
     * Get Pipeline by ID
     *
     * @return object Single pipeline
     */
    public static function getPipeline($id) {

        // GET /pipelines/{id}
        $data = API::http_get('/pipelines/' . $id);

        return API::safe_return($data);
    }

    /**
     * Add a new pipeline
     *
     * @return object New pipeline
     */
    public static function addPipeline(array $args) {

        // validation....

        $data = API::http_post('/pipelines', $args);

        return API::safe_return($data);
    }

}
?>