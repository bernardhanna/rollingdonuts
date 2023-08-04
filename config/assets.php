<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Assets Manifest
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default asset manifest that should be used.
    | The "theme" manifest is recommended as the default as it cedes ultimate
    | authority of your application's assets to the theme.
    |
    */

    'default' => 'app',

    /*
    |--------------------------------------------------------------------------
    | Assets Manifests
    |--------------------------------------------------------------------------
    |
    | Manifests contain lists of assets that are referenced by static keys that
    | point to dynamic locations, such as a cache-busted location. We currently
    | support two types of manifest:
    |
    | assets: key-value pairs to match assets to their revved counterparts
    |
    | bundles: a series of entrypoints for loading bundles
    |
    */

    'manifests' => [
        'app' => [
            'path' => public_path('/dist'),
            'url' => WP_HOME . '/dist',
            'assets' => public_path('dist/manifest.json'),
            'bundles' => public_path('dist/entrypoints.json'),
        ],
    ],
];
