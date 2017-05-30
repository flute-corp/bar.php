<?php

namespace ApiBundle\Entity;

use ApiBundle\Mixin\Labelisable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CategoryRepository")
 */
class Categorie
{

    use Labelisable;

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
     * @ORM\Column(name="icon", type="string", length=255)
     */
    private $icon;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="categorie")
     */
    private $articles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set icon
     *
     * @param string $icon
     *
     * @return Categorie
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Add article
     *
     * @param \ApiBundle\Entity\Article $article
     *
     * @return Categorie
     */
    public function addArticle(\ApiBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \ApiBundle\Entity\Article $article
     */
    public function removeArticle(\ApiBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
