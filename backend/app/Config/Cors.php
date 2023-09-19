<?php

namespace Config;


/**
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
 */
class Cors extends \Fluent\Cors\Config\Cors
{
    /**
     * @var array
     */
    public $allowedHeaders = ['*'];

    /**
     * @var array
     */
    public $allowedMethods = ['*'];

    /**
     * @var array
     */
    public $allowedOrigins = ['http://localhost:8081', 'http://localhost:8080'];

    /**
     * @var array
     */
    public $allowedOriginsPatterns = [];

    /**
     * @var array
     */
    public $exposedHeaders = [];

    /**
     * @var int
     */
    public $maxAge = 0;

    /**
     * @var boolean
     */
    public $supportsCredentials = true;
}
