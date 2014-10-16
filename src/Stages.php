<?php

namespace Pinvoice\Pipedrive;

/**
 * All functions for the Stage object in Pipedrive.
 */
class Stages {

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
	 * Get stage
	 *
	 * @param int $stage_id ID of stage to get
	 *
	 * @return array Returns data about a specific stage
	 */
	public static function getStage($stage_id) {

		// GET /stages/1
		$data = API::http_get('/stages/' . $stage_id);

		return API::safe_return($data);
	}

	/**
	 * Get all stages for pipeline
	 *
	 * @param int $pipeline_id ID of the pipeline to fetch stages for
	 *
	 * @return array Returns stages for provided pipeline
	 */

	public static function getStagesByPipelineId($pipeline_id) {

		// GET /stages/?pipeline_id=1

		// TODO: Disallow unexpected behaviour: If omitted, stages for all pipelines will be fetched.
		$data = API::http_get_with_params('/stages?pipeline_id=' . $pipeline_id);

		return API::safe_return($data);
	}
}
?>
