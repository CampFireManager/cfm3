<?php

return array(
    'console' => array(
        'router' => array(
            'routes' => array(
                'db' => array(
                    'options' => array(
                        'route' => 'db [update|version]:whattodo',
                        'defaults' => array(
                            'controller' => 'BKDbTitanic\Controller\Titanic',
                            'action' => 'db'
                        )
                    ),
                ),
            ),
        ),
    ),
);