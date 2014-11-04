<?php

namespace Pinvoice\Pipedrive;

class HTTP
{
    /**
     * HTTP GET wrapper for Curl.
     * For requests without additional query parameters.
     *
     * @param string $url URL to GET request to.
     * @return mixed Response data.
     */
    public static function get($url)
    {
        $curl = new \Curl\Curl();
        $curl->get(API::ENDPOINT . $url . '?api_token=' . API::getToken());
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
    public static function getWithParams($url)
    {
        $curl = new \Curl\Curl();
        $curl->get(API::ENDPOINT . $url . '&api_token=' . API::getToken());
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
    public static function post($url, array $args = array())
    {
        $curl = new \Curl\Curl();
        $curl->post(API::ENDPOINT . $url . '?api_token=' . API::getToken(), $args);
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
     * @throws Exception if param is not in accepted params.
     *
     * @return string Query string for HTTP request.
     */
    public static function buildQueryString($args, $accepted_params)
    {
        $query_string = "";
        $first = true;

        foreach ($args as $key => $val) {
            if (in_array($key, $accepted_params)) {
                if ($first) {
                    $query_string = $query_string . $key . '=' . $val;
                } else {
                    $query_string = $query_string . '&' . $key . '=' . $val;
                }
                $first = false;
            } else {
                throw new \Exception("Param '" . $key . "' does not exist in function " . debug_backtrace()[1]['function'] . ".");
            }
        }

        return $query_string;
    }

}