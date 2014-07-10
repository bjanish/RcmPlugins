<?php


namespace RcmTinyMce\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Class IncludeTinyMce
 *
 * IncludeTinyMce View helper
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmTinyMce\View\Helper
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class IncludeTinyMce extends AbstractHelper
{
    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke($options = array())
    {
        $this->inject($options);

        return;
    }

    /**
     * inject
     *
     * @return void
     */
    protected function inject($options = array())
    {
        $view = $this->getView();

        /** @var \Zend\View\Helper\HeadScript $headScript */
        $headScript = $view->headScript();

        $headScript->prependFile(
            '/modules/rcm-tinymce-js/tinymce/tinymce.min.js'
        );

    }
}