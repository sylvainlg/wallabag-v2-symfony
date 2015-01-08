<?php

  // src/Wallabag/Bundle/CoreBundle/Entity/User.php

  namespace Wallabag\Bundle\CoreBundle\Entity;

  use Symfony\Component\Security\Core\User\UserInterface;
  use Doctrine\ORM\Mapping as ORM;

  /**
  * Wallabag\Bundle\CoreBundle\Entity\User
  *
  * @ORM\Table(name="user")
  * @ORM\Entity(repositoryClass="Wallabag\Bundle\CoreBundle\Repository\UserRepository")
  */
  class User implements UserInterface, \Serializable
  {
      /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
      private $id;

      /**
      * @ORM\Column(type="string", length=25, unique=true)
      */
      private $username;

      /**
      * @ORM\Column(type="string", length=25, unique=true)
      */
      private $email;

      /**
      * @ORM\Column(type="string", length=32)
      */
      private $salt;

      /**
      * @ORM\Column(type="string", length=40)
      */
      private $password;

      /**
      * @ORM\Column(name="is_active", type="boolean")
      */
      private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $feedToken;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $authGoogleToken;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $authMozillaToken;

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

      public function __construct()
      {
          $this->isActive = true;
          $this->salt = md5(uniqid(null, true));
      }

      public function getId(){
          return $this->id;
      }

      /**
      * @inheritDoc
      */
      public function getUsername()
      {
          return $this->username;
      }

      /**
      * @inheritDoc
      */
      public function setUsername($username)
      {
          $this->username = $username;
          $this->email = $username;
      }

      /**
      * @inheritDoc
      */
      public function getSalt()
      {
          return $this->salt;
      }

      public function setSalt($salt)
      {
          $this->salt = $salt;
      }

      /**
      * @inheritDoc
      */
      public function getPassword()
      {
          return $this->password;
      }

      public function setPassword($password)
      {
          $this->password = $password;
      }

      /**
      * @inheritDoc
      */
      public function getRoles()
      {
          return array('ROLE_USER');
      }

      /**
      * @inheritDoc
      */
      public function eraseCredentials()
      {
      }

      /**
      * @see \Serializable::serialize()
      */
      public function serialize()
      {
          return serialize(
              array(
                  $this->id,
              )
          );
      }

      /**
      * @see \Serializable::unserialize()
      */
      public function unserialize($serialized)
      {
          list (
              $this->id,
              ) = unserialize($serialized);
      }

    /**
     * @return string
     */
    public function getAuthGoogleToken()
    {
        return $this->authGoogleToken;
    }

    /**
     * @param string $authGoogleToken
     */
    public function setAuthGoogleToken($authGoogleToken)
    {
        $this->authGoogleToken = $authGoogleToken;
    }

    /**
     * @return string
     */
    public function getAuthMozillaToken()
    {
        return $this->authMozillaToken;
    }

    /**
     * @param string $authMozillaToken
     */
    public function setAuthMozillaToken($authMozillaToken)
    {
        $this->authMozillaToken = $authMozillaToken;
    }

    /**
     * @return string
     */
    public function getFeedToken()
    {
        return $this->feedToken;
    }

    /**
     * @param string $feedToken
     */
    public function setFeedToken($feedToken)
    {
        $this->feedToken = $feedToken;
    }

    /**
     * Set preferences
     *
     * @param \Wallabag\Bundle\CoreBundle\Entity\Preference $preferences
     * @return self
     */
    public function setPreferences(Preference $preferences)
    {
        $this->preferences = $preferences;
        return $this;
    }

    /**
     * Get preferences
     *
     * @return \Wallabag\Bundle\CoreBundle\Entity\Preference $preferences
     */
    public function getPreferences()
    {
        return $this->preferences;
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

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return User
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }
}
