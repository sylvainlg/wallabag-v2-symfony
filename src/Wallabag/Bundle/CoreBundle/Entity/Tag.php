<?php

namespace Wallabag\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Tag
 *
 * @ORM\Entity
 * @ORM\Table(name="tag",uniqueConstraints={@ORM\UniqueConstraint(name="value_idx",columns={"value"})})
 */
class Tag
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
     * @ORM\Column(type="string", length=255)
     * @Expose
     * @Groups({"entries"})
     */
    private $value;

    /**
    * @var ArrayCollection
    *
    * @ORM\ManyToMany(targetEntity="Wallabag\Bundle\CoreBundle\Entity\Entry")
    */
    private $entries;

    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Tag
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add entry
     *
     * @param \Wallabag\Bundle\CoreBundle\Entiy\Entry $entry
     */
    public function addEntry(\Wallabag\Bundle\CoreBundle\Entiy\Entry $entry)
    {
        $this->entries[] = $entry;
    }

    /**
     * Remove entry
     *
     * @param \Wallabag\Bundle\CoreBundle\Entiy\Entry $entry
     */
    public function removeEntry(\Wallabag\Bundle\CoreBundle\Entiy\Entry $entry)
    {
        $this->entries->removeElement($entry);
    }

    public function flushEntries() {
        $this->entries->clear();
    }

    /**
     * Get entries
     *
     * @return Entry[] $entries
     */
    public function getEntries()
    {
        return $this->entries;
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
}
