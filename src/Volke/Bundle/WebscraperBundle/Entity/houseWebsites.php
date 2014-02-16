<?php

namespace Volke\Bundle\WebscraperBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\Table(name="houseWebsites")
 */
class houseWebsites
{

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

        /**
     * @ORM\Column(type="string", length=100)
     */
    protected $website;

	/**
     * @ORM\Column(type="string", length=100)
     */
    protected $coreUrl;

	/**
     * @ORM\Column(type="string", length=256)
     */
    protected $urlSuffix;

	/**
     * @ORM\Column(type="boolean")
     */
    protected $websiteExists;



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
     * Set name
     *
     * @param string $name
     * @return houseWebsites
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return houseWebsites
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set coreUrl
     *
     * @param string $coreUrl
     * @return houseWebsites
     */
    public function setCoreUrl($coreUrl)
    {
        $this->coreUrl = $coreUrl;

        return $this;
    }

    /**
     * Get coreUrl
     *
     * @return string 
     */
    public function getCoreUrl()
    {
        return $this->coreUrl;
    }

    /**
     * Set urlSuffix
     *
     * @param string $urlSuffix
     * @return houseWebsites
     */
    public function setUrlSuffix($urlSuffix)
    {
        $this->urlSuffix = $urlSuffix;

        return $this;
    }

    /**
     * Get urlSuffix
     *
     * @return string 
     */
    public function getUrlSuffix()
    {
        return $this->urlSuffix;
    }

    /**
     * Set websiteExists
     *
     * @param boolean $websiteExists
     * @return houseWebsites
     */
    public function setWebsiteExists($websiteExists)
    {
        $this->websiteExists = $websiteExists;

        return $this;
    }

    /**
     * Get websiteExists
     *
     * @return boolean 
     */
    public function getWebsiteExists()
    {
        return $this->websiteExists;
    }
}
