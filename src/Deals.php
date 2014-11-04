<?php

namespace Pinvoice\Pipedrive;

class Deals extends APIObject
{
    /**
     * Get all deals.
     *
     * HTTP GET /deals
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
    public static function getDeals($args = array())
    {
        $accepted_params = array(
            'filter_id', 'start', 'limit', 'sort_by', 'sort_mode', 'owned_by_you',
        );

        $query_string = HTTP::buildQueryString($args, $accepted_params);

        if (!empty($query_string)) {
            $data = HTTP::getWithParams('/deals?' . $query_string);
        } else {
            $data = HTTP::get('/deals');
        }

        return $this->safeReturn($data);
    }

    /**
     * Get deal.
     *
     * HTTP GET /deals/1
     *
     * @param int $deal_id ID of the deal (required).
     * @return array Object of specific deal.
     */
    public static function getDeal($deal_id)
    {
        $data = HTTP::get('/deals/' . $deal_id);
        return $this->safeReturn($data);
    }

    /**
     * Find deals by name.
     *
     * HTTP GET /deals/find
     *
     * @param array $args Array of several possible arguments:
     * $args['term']       string  Search term to look for (required).
     * $args['person_id']  number  ID of the person deal is associated with.
     * $args['org_id']     number  ID of the organization deal is associated with.
     * @return mixed Array of deal objects or NULL.
     */
    public static function getDealsByName(array $args)
    {
        $accepted_params = array(
            'term', 'person_id', 'org_id',
        );

        $query_string = HTTP::buildQueryString($args, $accepted_params);

        $data = HTTP::getWithParams('/deals/find?' . $query_string);

        return $this->safeReturn($data);
    }
}
