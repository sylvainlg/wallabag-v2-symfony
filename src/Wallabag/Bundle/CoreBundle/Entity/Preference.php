<?php


namespace Wallabag\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM; 

/*
 * Class Preference
 * @package Wallabag\Bundle\CoreBundle\Entity
 * @ORM\Entity
 */
class Preference {

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $locale;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $pageSize;

    /**
     * @var string
     * @ORM\Column(type="string", length=5)
     */
    private $sortDirection = 'asc';

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $theme = 'original';

    /**
     * Set locale
     *
     * @param string $locale
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Get locale
     *
     * @return string $locale
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set pageSize
     *
     * @param int $pageSize
     * @return self
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * Get pageSize
     *
     * @return int $pageSize
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * Set sortDirection
     *
     * @param string $sortDirection
     * @return self
     */
    public function setSortDirection($sortDirection)
    {
        $this->sortDirection = $sortDirection;
        return $this;
    }

    /**
     * Get sortDirection
     *
     * @return string $sortDirection
     */
    public function getSortDirection()
    {
        return $this->sortDirection;
    }

    /**
     * Set theme
     *
     * @param string $theme
     * @return self
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    /**
     * Get theme
     *
     * @return string $theme
     */
    public function getTheme()
    {
        return $this->theme;
    }
}