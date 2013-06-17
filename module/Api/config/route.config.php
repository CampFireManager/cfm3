<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Api\Controller\Index',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'api' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => 'api',
                            'defaults' => array(
                                'controller' => 'Api\Controller\Index',
                                'action' => 'index'
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array()
                    )
                )
            )
        )
    )
);
