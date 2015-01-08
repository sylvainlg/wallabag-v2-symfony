<?php

namespace Wallabag\Bundle\CoreBundle\Entity;

use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Entry
 * 
 * @ORM\Entity
 */
class Entry
{
    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Expose
     * @Groups({"entries"})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Expose
     * @Groups({"entries"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Expose
     * @Groups({"entries"})
     */
    private $content;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="Wallabag\Bundle\CoreBundle\Entity\User")
     */
    private $user;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Expose
     * @Groups({"entries"})
     */
    private $createdAt;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Wallabag\Bundle\CoreBundle\Entity\Tag")
     * @Expose
     * @Groups({"entries"})
     */
    private $tags;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"entries"})
     */
    private $archived = false;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"entries"})
     */
    private $deleted = false;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     * @Expose
     * @Groups({"entries"})
     */
    private $starred = false;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

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
     * Set url
     *
     * @param string $url
     * @return Entry
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Entry
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set content
     *
     * @param string $content
     * @return Entry
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * Get createdAt
     *
     * @return \DateTime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add tag
     *
     * @param \Wallabag\Bundle\CoreBundle\Entiy\Tag $tag
     */
    public function addTag(\Wallabag\Bundle\CoreBundle\Entiy\Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Remove tag
     *
     * @param \Wallabag\Bundle\CoreBundle\Entiy\Tag $tag
     */
    public function removeTag(\Wallabag\Bundle\CoreBundle\Entiy\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    public function flushTags() {
        $this->tags->clear();
    }

    /**
     * Get tags
     *
     * @return Tag[] $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     * @return self
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean $archived
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return self
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean $deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set starred
     *
     * @param boolean $starred
     * @return self
     */
    public function setStarred($starred)
    {
        $this->starred = $starred;
        return $this;
    }

    /**
     * Get starred
     *
     * @return boolean $starred
     */
    public function getStarred()
    {
        return $this->starred;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return self
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User $user
     */
    public function getUser()
    {
        return $this->user;
    }
}
