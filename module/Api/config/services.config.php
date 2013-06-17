<?php

return array(
    'service_manager' => array(
        'aliases' => array(
            'translator' => 'MvcTranslator'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Api\Controller\Index' => 'Api\Controller\IndexController'
        ),
    ),
);
