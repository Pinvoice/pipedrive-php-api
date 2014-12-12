<?php

namespace Pinvoice\Pipedrive;

use Curl\Curl;

class HTTP
{

    /**
     * Endpoint for Pipedrive, HTTP or HTTPS (configurable).
     * @var string
     */
    private $endpoint;

    /**
     * The Pipedrive API token.
     * @var string
     */
    private $token;

    /**
     * Set token and endpoint.
     */
    public function __construct($token, $endpoint)
    {
        $this->token = $token;
        $this->endpoint = $endpoint;
    }

    /**
     * HTTP GET wrapper for Curl.
     * For requests without additional query parameters.
     *
     * @param string $url URL to GET request to.
     * @return mixed Response data.
     */
    public function get($url)
    {
        $curl = new Curl();
        $curl->get($this->endpoint . $url . '?api_token=' . $this->token);
        $curl->close();

        return json_decode($curl->response);
    }

    /**
     * HTTP GET wrapper for Curl.
     * For requests with additional query paramters.
     *
     * @param string $url URL to GET request to.
     * @return mixed Response data.
     */
    public function getWithParams($url)
    {
        $curl = new Curl();
        $curl->get($this->endpoint . $url . '&api_token=' . $this->token);
        $curl->close();

        return json_decode($curl->response);
    }

    /**
     * HTTP POST wrapper for Curl.
     *
     * @param string $url URL to POST request to.
     * @param array $args POST data.
     * @return mixed Response data.
     */
    public function post($url, array $args = array())
    {
        $curl = new Curl();
        $curl->post($this->endpoint . $url . '?api_token=' . $this->token, $args);
        $curl->close();

        return json_decode($curl->response);
    }

    /**
     * Function to build the query string.
     * Will check which keys from $args are in $accepted_params, and build a query string from the key/val pairs.
     *
     * @param array $args Array of parameters (key,value).
     * @param array $accepted_params Accepted parameter keys.
     *
     * @throws \Exception if param is not in accepted params.
     * @return string Query string for HTTP request.
     */
    public function buildQueryString($args, $accepted_params)
    {
        $query_string = "";
        $first = true;

        foreach ($args as $key => $val) {
            if (in_array($key, $accepted_params)) {
                if ($first) {
                    $query_string .= $key . '=' . $val;
                } else {
                    $query_string .= '&' . $key . '=' . $val;
                }
                $first = false;
            } else {
                throw new \Exception("Param '" . $key . "' does not exist in function " .
                    debug_backtrace()[1]['function'] . ".");
            }
        }

        return $query_string;
    }

}
