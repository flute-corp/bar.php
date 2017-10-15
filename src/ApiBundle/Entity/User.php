<?php

namespace ApiBundle\Entity;

use ApiBundle\Mixin\Labelisable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    use Labelisable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @JMS\Groups({"getUsers"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @JMS\Groups({"postUsers"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @JMS\Groups({"postUsers"})
     * @JMS\Accessor(setter="setPassword")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity="Article")
     * @ORM\JoinTable(name="users_articles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id", unique=true)}
     *      )
     * @JMS\SerializedName("pref")
     * @JMS\Groups({"postUsers"})
     */
    private $favoris;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->favoris = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        return null;
    }

    public function setPassword($pass) {
        $this->password = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 13]);

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add favori
     *
     * @param \ApiBundle\Entity\Article $favori
     *
     * @return User
     */
    public function addFavori(\ApiBundle\Entity\Article $favori)
    {
        $this->favoris[] = $favori;

        return $this;
    }

    /**
     * Remove favori
     *
     * @param \ApiBundle\Entity\Article $favori
     */
    public function removeFavori(\ApiBundle\Entity\Article $favori)
    {
        $this->favoris->removeElement($favori);
    }

    /**
     * Get favoris
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoris()
    {
        return $this->favoris;
    }

    /**
     * Get array id Favoris
     *
     * @JMS\VirtualProperty()
     *
     * @JMS\Groups({"getUsers"})
     * @JMS\SerializedName("pref")
     */
    public function getArrayIdFavoris() {
        $aFav = $this->getFavoris();
        if ($aFav) {
            return $aFav->map(function (Article $oArticle) {
                return $oArticle->getId();
            });
        }
        return array();
    }
}
