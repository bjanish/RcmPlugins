<?php

/**
 * Reliv Common's Runtime Exception
 *
 * This file contains the methods to throw an SPL Runtime exception
 * from with in the Reliv Common Module
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @package   Common\Exception
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      http://ci.reliv.com/confluence
 */
namespace RcmPluginCommon\Exception;

/**
 * Reliv Common's Runtime Exception
 *
 * This file contains the methods to throw an SPL Runtime argument exception
 * from with in the Reliv Common Module
 *
 * @category  Reliv
 * @package   Common\Exception
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 * @link      http://ci.reliv.com/confluence
 */

class RuntimeException
    extends \RuntimeException
    implements \RcmPluginCommon\Exception\ExceptionInterface
{
    
}
