<?php

namespace Config;

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
     *
     * @var array<string, string>
     * @phpstan-var array<string, class-string>
     */

    public array $aliases = [
        'csrf' => CSRF::class,
        'toolbar' => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'invalidchars' => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth' => \App\Filters\AuthFilter::class, // Filtro de autenticación para roles
    ];

    /**
     * Global filters applied before and after every request.
     * To apply `auth` globally, uncomment it in the `before` array.
     */
    public array $globals = [
        'before' => [
            // 'auth', // Puedes descomentar para aplicar el filtro `auth` a todas las rutas
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * Filters applied on specific HTTP methods (e.g., POST only).
     */
    public array $methods = [];

    /**
     * Filters applied based on specific URI patterns.
     */
    // Config/Filters.php

    public array $filters = [
        'auth' => [
            'before' => [
                'usuarios',       // Protege la administración de usuarios
                'usuarios/*',
                'cliente',       // Protege la administración de clientes
                'cliente/*',
                'config',         // Protege las rutas de configuración
                'config/*',
                'venta',          // Protege las rutas de ventas si es necesario
                'venta/*',
            ],
        ],
    ];


}
