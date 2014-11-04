<?php

namespace Pinvoice\Pipedrive;

class API
{
    /**
     * Endpoint for Pipedrive, HTTP or HTTPS (configurable).
     */
    const ENDPOINT = 'http://api.pipedrive.com/v1/';

    /**
     * The current API instance.
     * @var object
     */
    private static $instance = null;

    /**
     * The Pipedrive API token.
     * @var string
     */
    private static $token = null;

    /**
     * The available API classes (configurable).
     * @var array
     */
    private static $classes = array('Deals', 'DealFields', 'Pipelines', 'Stages');

    /**
     * Returns singleton class instance.
     *
     * @return object Pipedrive API instance.
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Gets the API token.
     *
     * @return string API token
     */
    public static function getToken()
    {
        return self::$token;
    }

    /**
     * Sets the API token.
     *
     * @param string $token Pipedrive API token.
     *
     * @return void
     */
    public static function setToken($token)
    {
        self::$token = $token;
    }

    /**
     * Function used to allow dynamic methods like '$instance_of_API->getPipelines()'.
     * Only uses registered classes in self::$classes array (!).
     *
     * @param string $name Name of method to be called.
     * @param array $arguments Arguments to calll method with.
     *
     * @throws \Exception if method does not exist.
     * @return mixed Returns method if method exists.
     */
    public function __call($name, $arguments)
    {
        foreach (self::$classes as $class) {
            if (method_exists(__NAMESPACE__ . '\\APIObjects\\' . $class, $name)) {
                return call_user_func_array(
                    __NAMESPACE__ . '\\APIObjects\\' . $class . '::' . $name, $arguments
                );
            }
        }
        throw new \Exception("Method '" . $name . "' does not exist.");
    }

}
