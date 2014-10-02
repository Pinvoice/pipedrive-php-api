<?php
namespace Pinvoice\Pipedrive;

// Require Composer packages
require_once ('vendor/autoload.php');

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
     * The available API classes
     */
    private static $classes = array('Pipelines', 'Stages');

    /**
     * The API endpoint to use
     */
    const ENDPOINT = 'http://api.pipedrive.com/v1/';

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
    
    public function __call($name, $arguments)
    {
        foreach(self::$classes as $class) {
          if (method_exists (__NAMESPACE__ . '\\' . $class, $name))
          {
            return call_user_func_array(__NAMESPACE__ . '\\' . $class . '::' . $name, $arguments);
          }
          
      }
      return null; // or error
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

    public static function http_get_with_params($url) {
        $curl = new \Curl\Curl();
        $curl->get(self::ENDPOINT . $url . '&api_token=' . self::getToken());
        $curl->close();
        
        return json_decode($curl->response);
    }

    public static function http_post($url, array $args = array()) {
        $curl = new \Curl\Curl();
        $curl->post(self::ENDPOINT . $url . '?api_token=' . self::getToken(), $args);
        $curl->close();
        
        return json_decode($curl->response);
    }
    
}
?>
