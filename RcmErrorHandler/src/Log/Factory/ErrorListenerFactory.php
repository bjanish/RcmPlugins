<?php

namespace RcmErrorHandler\Log\Factory;

use RcmErrorHandler\Log\ErrorListener;
use RcmErrorHandler\Model\Config;
use Zend\Log\Logger;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ErrorListenerFactory
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */

class ErrorListenerFactory  implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $config = $serviceLocator->get('\RcmErrorHandler\Config');

        $listenerConfigs = $config->get('listener');

        $listenerConfigArr = [];

        if(isset($listenerConfigs['\RcmErrorHandler\Log\ErrorListener'])) {

            $listenerConfigArr = $listenerConfigs['\RcmErrorHandler\Log\ErrorListener'];
        }

        $listenerConfig = new Config($listenerConfigArr);

        $loggerConfigs = $config->get('loggers');

        $loggerConfig = [];

        if(isset($loggerConfigs['\Zend\Log\Logger'])) {

            $loggerConfig = $loggerConfigs['\Zend\Log\Logger'];
        }

        $loggerOptions = [];

        if(isset($loggerConfig['options'])){

            $loggerOptions = $loggerConfig['options'];
        }

        $logger = new Logger($loggerOptions);

        var_dump($logger); die;

        return new ErrorListener($listenerConfig, $logger);
    }
}