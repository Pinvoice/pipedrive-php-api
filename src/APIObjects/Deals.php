<?php

namespace Pinvoice\Pipedrive\APIObjects;

class Deals extends APIObject
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
    public function getDeals($args = array())
    {
        if (!empty($query_string)) {
            $data = $this->http->getWithParams('/deals', $args);
        } else {
            $data = $this->http->get('/deals');
        }

        return $this->safeReturn($data);
    }

    /**
     * Get deal.
     *
     * HTTP GET /deals/1
     *
     * @param int $id ID of the deal (required).
     * @return array Object of specific deal.
     */
    public function getDeal($id)
    {
        $this->validateDigit($id);
        $data = $this->http->get('/deals/' . $id);

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
    public function getDealsByName(array $args)
    {
        $data = $this->http->getWithParams('/deals/find', $args);

        return $this->safeReturn($data);
    }
}
