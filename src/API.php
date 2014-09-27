<?php
namespace Pinvoice\Pipedrive;

// Require Composer packages
require_once ('vendor/autoload.php');

// Require API objects
require_once ('Pipelines.php');

class API
{
    
    /**
     * The current API instance
     */
    private static $_instance = null;
    
    /**
     * The Pipedrive API token
     */
    private static $token = null;
    
    /**
     * The API endpoint to use
     */
    const ENDPOINT = 'https://api.pipedrive.com/v1/';

    /**
     * Returns singleton class instance
     *
     * @return object Pipedrive API instance
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    /**
     * Gets the API token
     *
     * @return string API token
     */
    public static function getToken() {
        return self::$token;
    }
    
    /**
     * Sets the API token
     *
     * @param string $token Pipedrive API token
     *
     * @return void
     */
    public static function setToken($token) {
        self::$token = $token;
    }
    
    /**
     * Handles errors for requests
     * @param array $data JSON object
     *
     * @return array
     */
    public static function safe_return($data) {
        if (!$data->success) {
            throw new \Exception(isset($data->error) ? $data->error : "Unknown error");
        } else {
            return $data->data;
        }
    }

    public static function http_get($url) {
        $curl = new \Curl\Curl();
        $curl->get(self::ENDPOINT . $url . '?api_token=' . self::getToken());
        $curl->close();
        
        return json_decode($curl->response);
    }
    
    /**
     * Define API funcs
     */
    public static function getPipelines() {
        return Pipelines::getPipelines();
    }
    public static function getPipeline($id) {
        return Pipelines::getPipeline($id);
    }
    
    // etc...
    
    
}
?>
