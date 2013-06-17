<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'child_routes' => array(
                    'api' => array(
                        'child_routes' => array(
                            'talk' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/talk',
                                    'defaults' => array(
                                        'controller' => 'Talk\Controller\Index',
                                        'action' => 'list'
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    
                                )
                            )
                        )
                    )
                )
            )
        )
    )
);
