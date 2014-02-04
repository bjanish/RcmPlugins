<?php
/**
 * Reliv Common's Invalid Argument Exception
 *
 * This file contains the methods to throw an SPL invalid argument exception
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
 */
namespace RcmEventCalenderCore\Exception;

/**
 * Invalid Argument Exception for RcmEventCalenderCore
 *
 * This file contains the methods to throw an SPL invalid argument exception
 * from with RcmEventCalenderCore
 *
 * @category  Reliv
 * @package   Common\Exception
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 */
class InvalidArgumentException
    extends \InvalidArgumentException
    implements \RcmEventCalenderCore\Exception\ExceptionInterface
{

}
