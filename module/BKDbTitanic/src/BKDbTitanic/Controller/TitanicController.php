<?php

namespace BKDbTitanic\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Description of TitanicController
 *
 * @author Kat
 */
class TitanicController extends AbstractActionController
{

    public function dbAction()
    {
        echo "DATABASE:\n ". __METHOD__." ".__LINE__."\n";
    }

}

