<?php

namespace Msi\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Msi\ContentBundle\Entity\Page
 */
class Page
{

    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $layout_id
     */
    private $layout_id;

    /**
     * @var integer $user_id
     */
    private $user_id;

    /**
     * @var integer $page_category_id
     */
    private $page_category_id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var text $body
     */
    private $body;

    /**
     * @var string $unique_title
     */
    private $unique_title;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var boolean $homepage
     */
    private $homepage;

    /**
     * @var datetime $created
     */
    private $created;

    /**
     * @var datetime $updated
     */
    private $updated;

    /**
     * @var Msi\ContentBundle\Entity\PageCategory
     */
    private $pageCategory;

    /**
     * @var Msi\ContentBundle\Entity\Layout
     */
    private $layout;

    /**
     * @var Msi\UserBundle\Entity\User
     */
    private $user;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set layout_id
     *
     * @param integer $layoutId
     */
    public function setLayoutId($layoutId)
    {
        $this->layout_id = $layoutId;
    }

    /**
     * Get layout_id
     *
     * @return integer 
     */
    public function getLayoutId()
    {
        return $this->layout_id;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set page_category_id
     *
     * @param integer $pageCategoryId
     */
    public function setPageCategoryId($pageCategoryId)
    {
        $this->page_category_id = $pageCategoryId;
    }

    /**
     * Get page_category_id
     *
     * @return integer 
     */
    public function getPageCategoryId()
    {
        return $this->page_category_id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set unique_title
     *
     * @param string $uniqueTitle
     */
    public function setUniqueTitle($uniqueTitle)
    {
        $this->unique_title = $uniqueTitle;
    }

    /**
     * Get unique_title
     *
     * @return string 
     */
    public function getUniqueTitle()
    {
        return $this->unique_title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set homepage
     *
     * @param boolean $homepage
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    }

    /**
     * Get homepage
     *
     * @return boolean 
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set pageCategory
     *
     * @param Msi\ContentBundle\Entity\PageCategory $pageCategory
     */
    public function setPageCategory(\Msi\ContentBundle\Entity\PageCategory $pageCategory)
    {
        $this->pageCategory = $pageCategory;
    }

    /**
     * Get pageCategory
     *
     * @return Msi\ContentBundle\Entity\PageCategory 
     */
    public function getPageCategory()
    {
        return $this->pageCategory;
    }

    /**
     * Set layout
     *
     * @param Msi\ContentBundle\Entity\Layout $layout
     */
    public function setLayout(\Msi\ContentBundle\Entity\Layout $layout)
    {
        $this->layout = $layout;
    }

    /**
     * Get layout
     *
     * @return Msi\ContentBundle\Entity\Layout 
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set user
     *
     * @param Msi\UserBundle\Entity\User $user
     */
    public function setUser(\Msi\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Msi\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var boolean $status
     */
    private $status;


    /**
     * Set status
     *
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
}