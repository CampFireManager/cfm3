<?php

return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\IndexController',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array()
            )
        )
    )
);