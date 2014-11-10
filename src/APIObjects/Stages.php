<?php

namespace Pinvoice\Pipedrive\APIObjects;

use Pinvoice\Pipedrive\HTTP;

class Stages extends APIObject {

	/**
	 * [__construct description]
	 * @param [type] $http [description]
	 */
	public function __construct($http) {
		parent::__construct($http);
	}

	/**
	 * Get all stages.
	 *
	 * HTTP GET /stages
	 *
	 * @return array Returns data about all stages
	 */
	public function getStages() {
		$data = $this->http->get('/stages');
		return $this->safeReturn($data);
	}

	/**
	 * Get stage.
	 *
	 * HTTP GET /stages/1
	 *
	 * @param int $stage_id ID of stage to get
	 * @return array Returns data about a specific stage
	 */
	public function getStage($stage_id) {
		$data = $this->http->get('/stages/' . $stage_id);
		return $this->safeReturn($data);
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
	public function getStagesByPipelineId($pipeline_id) {
		if (is_numeric($pipeline_id)) {
			$data = $this->http->getWithParams('/stages?pipeline_id=' . $pipeline_id);
		} else {
			throw new \Exception("Param pipeline_id should be numeric.");
		}
		return $this->safeReturn($data);
	}

}
