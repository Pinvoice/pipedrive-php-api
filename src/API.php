<?php

namespace Pinvoice\Pipedrive;

use Pinvoice\Pipedrive\APIObjects\Deals;
use Pinvoice\Pipedrive\APIObjects\DealFields;
use Pinvoice\Pipedrive\APIObjects\Persons;
use Pinvoice\Pipedrive\APIObjects\PersonFields;
use Pinvoice\Pipedrive\APIObjects\Pipelines;
use Pinvoice\Pipedrive\APIObjects\Stages;

class API
{
    /**
     * Endpoint for Pipedrive, HTTP or HTTPS (configurable).
     */
    private $endpoint = 'http://api.pipedrive.com/v1/';

    /**
     * The Pipedrive API token.
     * @var string
     */
    private $token = null;

    /**
     * The HTTP instance for HTTP requests.
     * @var object
     */
    private $http;

    /**
     * The APIObject instances.
     * @var objects
     */
    public $deals;
    public $dealfields;
    public $persons;
    public $personfields;
    public $pipelines;
    public $stages;

    /**
     * [__construct description]
     * @param [type] $token [description]
     */
    public function __construct($token) {
        /**
         * Initialize HTTP client.
         */
        $this->token = $token;
        $this->http = new HTTP($this->token, $this->endpoint);

        /**
         * Initialize APIObjects
         */
        $this->deals        = new Deals($this->http);
        $this->dealfields   = new DealFields($this->http);
        $this->persons      = new Persons($this->http);
        $this->personfields = new PersonFields($this->http);
        $this->pipelines    = new Pipelines($this->http);
        $this->stages       = new Stages($this->http);
    }
}
