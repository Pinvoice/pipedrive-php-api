<?php

namespace Pinvoice\Pipedrive\APIObjects;

class Persons extends APIObject
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
     * Get all persons.
     *
     * HTTP GET /persons
     *
     * @param array $args Array of several possible arguments:
     * $args['filter_id']     number      ID of the filter to use.
     * $args['start']         number      Pagination start.
     * $args['limit']         number      Items shown per page.
     * $args['sort_by']       string      Field name (key) to sort with. Only first-level field keys are supported (no nested keys).
     * $args['sort_mode']     enumerated  "asc" (ascending) OR "desc (descending).
     *
     * @return array Array of all person objects.
     */
    public function getPersons($args = array())
    {
        $accepted_params = array(
            'filter_id', 'start', 'limit', 'sort_by', 'sort_mode',
        );

        $query_string = $this->http->buildQueryString($args, $accepted_params);

        if (!empty($query_string)) {
            $data = $this->http->getWithParams('/persons?' . $query_string);
        } else {
            $data = $this->http->get('/persons');
        }

        return $this->safeReturn($data);
    }

    /**
     * Get person.
     *
     * HTTP GET /persons/1
     *
     * @param int $person_id ID of the person (required).
     * @return array Object of specific person.
     */
    public function getPerson($person_id)
    {
        $data = $this->http->get('/persons/' . $person_id);
        return $this->safeReturn($data);
    }

    /**
     * Find persons by name.
     *
     * HTTP GET /persons/find
     *
     * @param array $args Array of several possible arguments:
     * $args['term']            string  Search term to look for (required).
     * $args['person_id']       number  ID of the person person is associated with.
     * $args['org_id']          number  ID of the organization person is associated with.
     * $args['start']           number  Pagination start
     * $args['limit']           number  Items shown per page
     * $args['search_by_email'] boolean When enabled, term will only be matched against email addresses of people. Default: false
     * @return mixed Array of person objects or NULL.
     */
    public function getPersonsByName(array $args)
    {
        $accepted_params = array(
            'term', 'person_id', 'org_id', 'start', 'limit', 'search_by_email',
        );

        $query_string = $this->http->buildQueryString($args, $accepted_params);

        $data = $this->http->getWithParams('/persons/find?' . $query_string);

        return $this->safeReturn($data);
    }

}
