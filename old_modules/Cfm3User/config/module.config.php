<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Cfm3UserAdmin' => 'Cfm3User\Controller\AdminController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'user' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/user[/:action][/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Cfm3UserAdmin',
                                'action' => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'template_map' => array(
//            'movie/index/index' => __DIR__ . '/../view/movie/index/index.phtml',
        ),
        'template_path_stack' => array(
            realpath(__DIR__ . '/../view'),
        ),
    ),
);