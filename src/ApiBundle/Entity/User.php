<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Article")
     * @ORM\JoinTable(name="users_articles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $favoris;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->favoris = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return User
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
}
