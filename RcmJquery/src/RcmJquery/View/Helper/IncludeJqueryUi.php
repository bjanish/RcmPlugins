<?php
/**
 * Include Jquery View helper
 *
 * This view helper includes jquery, jqueryui, and block-ui JS
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmJquery
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */

namespace RcmJquery\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Include Jquery View helper
 *
 * This view helper includes jquery, jqueryui, and block-ui JS
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmJquery
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class IncludeJqueryUi extends AbstractHelper
{
    /**
     * Adds Jquery JS includes to the html
     *
     * @return null
     */
    public function __invoke()
    {
        $view = $this->getView();

        $view->headLink()->prependStylesheet(
            '/modules/rcm-jquery/jquery-ui-1.10.4.custom/css/'
            . 'smoothness/jquery-ui-1.10.4.custom.min.css'
        );

        $view->headScript()->appendFile(
            '/modules/rcm-jquery/jquery-ui-1.10.4.custom/js/'
            . 'jquery-ui-1.10.4.custom.min.js'
        );

        $view->rcmIncludeJquery();
    }
}