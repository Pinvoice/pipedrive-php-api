<?php

namespace Pinvoice\Pipedrive;

/**
 * All functions for the Deal object in Pipedrive.
 */
class Deals {

	/**
	 * Get all deals.
	 *
	 * @param array $args Array of several possible arguments:
	 * $args['filter_id']     number      ID of the filter to use.
	 * $args['start']         number      Pagination start.
	 * $args['limit']         number      Items shown per page.
	 * $args['sort_by']       string      Field name (key) to sort with. Only first-level field keys are supported (no nested keys).
	 * $args['sort_mode']     enumerated  "asc" (ascending) OR "desc (descending).
	 * $args['owned_by_you']  boolean     When supplied, only deals owned by you are returned.
	 *
	 * @return array Array of all deal objects.
	 */
	public static function getDeals($args = array()) {

		$accepted_params = array('filter_id', 'start', 'limit', 'sort_by', 'sort_mode', 'owned_by_you');
		$query_string = API::build_query_string($args, $accepted_params);

		// GET /deals
		if (!empty($query_string)) {
			$data = API::http_get_with_params('/deals?' . $query_string);
		} else {
			$data = API::http_get('/deals');
		}

		return API::safe_return($data);
	}

	/**
	 * Get deal
	 *
	 * @param int $deal_id ID of the deal (required).
	 *
	 * @return array Object of specific deal.
	 */
	public static function getDeal($deal_id) {

		// GET /deals/1
		$data = API::http_get('/deals/' . $deal_id);

		return API::safe_return($data);
	}

	/**
	 * Find deals by name.
	 *
	 * @param array $args Array of several possible arguments:
	 * $args['term']       string  Search term to look for (required).
	 * $args['person_id']  number  ID of the person deal is associated with.
	 * $args['org_id']     number  ID of the organization deal is associated with.
	 *
	 * @return mixed Array of deal objects or NULL.
	 */
	public static function getDealsByName(array $args) {

		$accepted_params = array('term', 'person_id', 'org_id');
		$query_string = API::build_query_string($args, $accepted_params);

		// GET /deals/find
		$data = API::http_get_with_params('/deals/find?' . $query_string);

		return API::safe_return($data);
	}
}
?>
