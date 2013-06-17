<?php
namespace Talk;
use BKUtil\ModuleUtil;

class Module {
    function getConfig() {
        return ModuleUtil::getMergedConfigFromDir(__DIR__ . "/config/");
    }

    function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
