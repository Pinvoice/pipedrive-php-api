<?php

namespace Pinvoice\Pipedrive\APIObjects;

use Pinvoice\Pipedrive\HTTP;

class Pipelines extends APIObject {

	/**
	 * [__construct description]
	 * @param [type] $http [description]
	 */
	public function __construct($http) {
		parent::__construct($http);
	}

	/**
	 * Get Pipelines.
	 *
	 * HTTP GET /pipelines
	 *
	 * @return array Array of pipelines
	 */
	public function getPipelines() {
		$data = $this->http->get('/pipelines');
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
	public function getPipeline($id) {
		$data = $this->http->get('/pipelines/' . $id);
		return self::safeReturn($data);
	}

	/**
	 * Add a new pipeline.
	 *
	 * @param array $args Array of several possible arguments
	 * @return object New pipeline
	 */
	public function addPipeline(array $args) {
		// TODO: Arguments in doc and validation...
		$data = $this->http->post('/pipelines', $args);
		return self::safeReturn($data);
	}

}
