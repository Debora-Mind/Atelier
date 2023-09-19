<?php

namespace Config;

use App\Filters\LoginFilter;
use App\Filters\Throttle;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
//        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'throttle'      => Throttle::class,
        'login'         => LoginFilter::class,
        'cors'          => \Fluent\Cors\Filters\CorsFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
             'honeypot',
//             'csrf',
            //'login' => ['before' => ['sistema', 'sistema/*']],
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
             'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = ['throttle'];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
//        'login' => ['before' => ['sistema*', 'producao*', 'notas*', 'usuarios*', 'empresa*', 'painel*']],
        'cors' => [
            'before' => ['api/*'], // Certifique-se de que as rotas relevantes estão listadas aqui
            'after' => ['api/*']
            ]
    ];
}
