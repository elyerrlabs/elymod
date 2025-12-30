<?php
/**
 * This file is part of the {{ Module }}}} package.
 *
 * It defines shared menu configuration for the identity system.
 * Menus declared here can be merged and consumed by core, system,
 * and third-party modules.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Shared Menu Definitions
    |--------------------------------------------------------------------------
    |
    | Menus defined under the "merge" key are automatically shared across
    | the application. Each menu entry must follow a consistent structure
    | so it can be rendered correctly by the UI layer.
    |
    | Required fields:
    | - id:      Unique menu identifier
    | - name:    Display name
    | - route:   Named route
    | - icon:    Material Design icon (mdi-* webfont)
    | - service: Access scope in the format "group:service"
    |
    */

    'merge' => [

        /*
        |----------------------------------------------------------------------
        | Admin Dashboard Menu
        |----------------------------------------------------------------------
        |
        | Menu items displayed in the administrative dashboard.
        | Intended for system administrators and privileged users.
        |
        */
        'admin_dashboard' => [

            /*
            '{{ module }}-admin' => [
                'id'      => '{{ module }}-admin',
                'name'    => 'ElyMod Admin',
                'route'   => 'module.{{ module }}.web.welcome',
                'icon'    => 'mdi-security',
                'service' => 'administrator:admin',
            ],
            */

        ],

        /*
        |----------------------------------------------------------------------
        | User Application Menu
        |----------------------------------------------------------------------
        |
        | Routes displayed in the main application menu for authenticated users.
        |
        */
        'user_routes' => [

            /*
            '{{ module }}-app' => [
                'id'      => '{{ module }}-app',
                'name'    => 'ElyMod',
                'route'   => 'module.{{ module }}.web.welcome',
                'icon'    => 'mdi-application',
                'service' => 'user:access',
            ],
            */

        ],

        /*
        |----------------------------------------------------------------------
        | Admin Applications (User Accessible)
        |----------------------------------------------------------------------
        |
        | Administrative applications that a user may access depending on
        | granted permissions or service scopes.
        |
        | These entries are typically shown in admin application sections
        | rather than global dashboards.
        |
        */
        'admin_routes' => [
            /*
            '{{ module }}-admin-app' => [
                'id'      => '{{ module }}-app',
                'name'    => 'ElyMod',
                'route'   => 'module.{{ module }}.web.welcome',
                'icon'    => 'mdi-application',
                'service' => 'user:access',
            ],
            */
        ],

        /*
        |----------------------------------------------------------------------
        | User Settings Menu
        |----------------------------------------------------------------------
        |
        | Menu entries displayed under the user settings section.
        |
        */
        'user_settings' => [

            /*
            '{{ module }}-settings' => [
                'id'      => '{{ module }}-settings',
                'name'    => 'ElyMod Settings',
                'route'   => 'module.{{ module }}.web.settings',
                'icon'    => 'mdi-cog',
                'service' => 'user:settings',
            ],
            */

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Module-Specific Admin Routes
    |--------------------------------------------------------------------------
    |
    | Allows injecting additional menu entries into a specific module’s
    | administrative area.
    |
    | The key used here must match the target module key.
    | Each route definition must follow the same structure as shared menus.
    |
    */

    'admin_routes' => [
        /*
        [
            'id' => '{{ module }}',
            'name' => 'ElyMod',
            'route' => 'module.{{ module }}.web.welcome',
            'icon' => 'mdi-store-cog',
            'service' => true,
            'position' => 8,
        ],
        */
    ],

];
