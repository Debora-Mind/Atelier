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
    public $allowedOrigins = ['http://localhost:8081', 'http://localhost:8080', 'https://atelier-pearl.vercel.app/', 'https://atelier-8ws4hjml4-debora-mind.vercel.app/'];

    /**
     * @var array
     */
    public $allowedOriginsPatterns = ['https://atelier-pearl.vercel.app/', 'https://atelier-8ws4hjml4-debora-mind.vercel.app/'];

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
