<?php
/**
 * Admin User Database Entity
 *
 * This is a Doctorine 2 definition file for Admin User Objects.
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @package   Common\Entites
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      http://ci.reliv.com/confluence
 */

namespace RcmLogin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rcm\Entity\Site;
use Rcm\Entity\Page;

/**
 * Admin User Database Entity
 *
 * This contains all the Admin info and permissions
 *
 * @category  Reliv
 * @package   Common\Entites
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 * @link      http://ci.reliv.com/confluence
 *
 * @ORM\Entity
 * @ORM\Table(name="rcm_admin_users")
 */

class AdminUser
{
    /**
     * @var int Auto-Incremented Primary Key
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $adminId;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $accountNumber;

    /**
     * @ORM\ManyToMany(targetEntity="Rcm\Entity\Site")
     * @ORM\JoinTable(
     *     name="rcm_admin_allowed_sites",
     *     joinColumns={
     *         @ORM\JoinColumn(
     *             name="admin_id",
     *             referencedColumnName="adminId"
     *         )
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(
     *             name="site_id",
     *             referencedColumnName="siteId"
     *         )
     *     }
     * )
     **/
    protected $allowedSites;

    /**
     * @ORM\ManyToMany(targetEntity="Rcm\Entity\Page")
     * @ORM\JoinTable(
     *     name="rcm_admin_disallowed_pages",
     *     joinColumns={
     *         @ORM\JoinColumn(
     *             name="admin_id",
     *             referencedColumnName="adminId"
     *         )
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(
     *             name="page_id",
     *             referencedColumnName="pageId"
     *         )
     *     }
     * )
     **/
    protected $restrictedPages;

    /**
     * @ORM\Column(type="string", nullable=true)
     **/
    protected $restrictedPlugins;


    /**
     * @ORM\Column(type="boolean")
     */
    protected $createNew=false;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $createFromTemplate=false;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $managePageLayout=false;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $editPage=false;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $editSiteWidePlugins=false;

    public function __construct()
    {
        $this->sites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->restrictedPages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->restrictedPlugins = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function isAdmin()
    {
        if (empty($this->adminId)) {
            return false;
        }

        return true;
    }

    public function canEditSite(\Rcm\Entity\Site $site)
    {
        if (empty($this->sites[$site->getSiteId()])) {
            return false;
        }

        return $this->editPage;
    }

    public function setAllowedSite(\Rcm\Entity\Site $allowedSite)
    {
        $this->allowedSites[$allowedSite->getSiteId()] = $allowedSite;
        return $this;
    }

    public function canEditPage(\Rcm\Entity\Page $page)
    {
        if (!empty($this->restrictedPages[$page->getPageId()])) {
            return false;
        }

        return $this->editPage;
    }

    function setRestrictedPage(\Rcm\Entity\Page $page)
    {
        $this->restrictedPages[$page->getPageId()] = $page;
        return $this;
    }

    public function canEditPlugin(\Rcm\Entity\AvailablePlugin $plugin)
    {
        if (!empty($this->restrictedPlugins[$plugin->getId()])) {
            return false;
        }

        return $this->editPage;
    }

    function setRestrictedPlugin(\Rcm\Entity\AvailablePlugin $plugin)
    {
        $this->restrictedPlugins[$plugin->getId()] = $plugin;
        return $this;
    }

    public function canCreateNewPage()
    {
        return $this->createNew;
    }

    public function setCreateNewPage($allowed=false) {
        $this->createNew = $allowed;
        return $this;
    }

    public function canCreateFromTemplate()
    {
        return $this->createFromTemplate;
    }

    public function setCreateFromTemplate($allowed=false)
    {
        $this->createFromTemplate = $allowed;
        return $this;
    }

    public function canManagePageLayout()
    {
        return $this->managePageLayout;
    }

    public function setManagePageLayout($allowed=false)
    {
        $this->managePageLayout = $allowed;
        return $this;
    }

    public function canEditSiteWidePlugins()
    {
        return $this->editSiteWidePlugins;
    }

    public function setEditSiteWidePlugins($allowed=false)
    {
        $this->editSiteWidePlugins = $allowed;

        return $this;
    }

    public function setAccountNumber($accountNum)
    {
        $this->accountNumber = $accountNum;
    }
}