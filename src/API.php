<?php

namespace Pinvoice\Pipedrive;

use Pinvoice\Pipedrive\APIObjects\DealFields;
use Pinvoice\Pipedrive\APIObjects\Deals;
use Pinvoice\Pipedrive\APIObjects\PersonFields;
use Pinvoice\Pipedrive\APIObjects\Persons;
use Pinvoice\Pipedrive\APIObjects\Pipelines;
use Pinvoice\Pipedrive\APIObjects\Stages;

class API
{
    public $deals;
    public $dealfields;
    public $persons;
    public $personfields;
    public $pipelines;
    public $stages;

    /**
     * Endpoint for Pipedrive, HTTP or HTTPS (configurable).
     * @var string
     */
    private $endpoint = 'http://api.pipedrive.com/v1/';

    /**
     * The Pipedrive API token.
     * @var string
     */
    private $token = null;

    /**
     * Holds the HTTP instance for HTTP requests.
     * @var object
     */
    private $http;

    /**
     * Set HTTP with endpoint and token. Create classes for each API object.
     * @param string $token Pipedrive API token.
     * @param string $endpoint Pipedrive API endopoint.
     */
    public function __construct($token, $endpoint = null)
    {
        $this->token = $token;
        if(isset($endpoint)){
           $this->endpoint = $endpoint; 
        }
        $this->http = new HTTP($this->token, $this->endpoint);

        $this->deals = new Deals($this->http);
        $this->dealfields = new DealFields($this->http);
        $this->persons = new Persons($this->http);
        $this->personfields = new PersonFields($this->http);
        $this->pipelines = new Pipelines($this->http);
        $this->stages = new Stages($this->http);
    }

    public function isAuthenticated()
    {
        $response = $this->http->get('userSettings');
        return $response->success;
    }

}
