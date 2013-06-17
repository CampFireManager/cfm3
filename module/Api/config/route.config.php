<?php

return array(
    'router' => array(
        'routes' => array(
            'api' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/api',
                    'defaults' => array(
                        'controller' => 'Api\Controller\IndexController',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array()
            )
        )
    )
);