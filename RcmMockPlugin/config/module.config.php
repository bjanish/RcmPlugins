<?php

/**
 * ZF2 Plugin Config file
 *
 * This file contains all the configuration for the Module as defined by ZF2.
 * See the docs for ZF2 for more information.
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 */

return [

    'rcmPlugin' => [
        'RcmMockPlugin' => [
            'type' => 'Common',
            'display' => 'Mock Object Display Name',
            'tooltip' => 'This plugin does absolutely nothing.  Do not use!',
            'icon' => ''
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'RcmMockPlugin' => 'RcmMockPlugin\Factory\PluginControllerFactory'
        ]
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'aliases' => [
                'modules/rcm-mock-plugin/' => __DIR__ . '/../public/',
            ],
            'collections' => [
                'modules/rcm/modules.js' => [
                    'modules/rcm-mock-plugin/script.js'
                ],
                'modules/rcm/modules.css' => [
                    'modules/rcm-mock-plugin/style.css'
                ],
                'modules/rcm-admin/admin.js' => [
                    'modules/rcm-message-list/rcm-message-list-edit.js',
                ],
            ],
        ],
    ],
];
