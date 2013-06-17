<?php

namespace BKUtil;

use DirectoryIterator;
use RegexIterator;
use Zend\Stdlib\ArrayUtils;
/**
 * Description of ModuleAbstract
 *
 * @author Kat
 */
class ModuleUtil
{
    public static function getMergedConfigFromDir($cfgDir)
    {
        $config = array();
        $iterator = new DirectoryIterator($cfgDir);
        $filteredIterator = new RegexIterator($iterator, '/.config.php$/i');
        foreach ($filteredIterator as $configFile) {
            $config = ArrayUtils::merge($config, include $configFile->getPathname());
        }
        return $config;
    }
}
