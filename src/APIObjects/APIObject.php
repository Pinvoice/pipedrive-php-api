<?php

namespace Pinvoice\Pipedrive\APIObjects;

abstract class APIObject {

	/**
	 * [$http description]
	 * @var [type]
	 */
	protected $http;

	/**
	 * [__construct description]
	 * @param [type] $http [description]
	 */
	protected function __construct($http) {
		$this->http = $http;
	}

	/**
	 * Handles errors in Pipedrive API requests.
	 *
	 * @param array $data JSON object.
	 *
	 * @throws \Exception if $data->success isn't there.
	 * @return mixed Return data.
	 */
	protected static function safeReturn($data) {
		if (!$data->success) {
			throw new \Exception(isset($data->error) ? $data->error : "Unknown error.");
		} else {
			return $data->data;
		}
	}
}
