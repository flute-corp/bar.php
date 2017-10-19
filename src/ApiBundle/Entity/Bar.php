<?php

namespace ApiBundle\Entity;

use ApiBundle\Mixin\Labelisable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bar
 *
 * @ORM\Table(name="bar")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\BarRepository")
 */
class Bar
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
     * @ORM\OneToMany(targetEntity="BarArticle", mappedBy="bar")
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
     * @param mixed $articles
     * @return Bar
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add article
     *
     * @param \ApiBundle\Entity\BarArticle $article
     *
     * @return Bar
     */
    public function addArticle(\ApiBundle\Entity\BarArticle $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \ApiBundle\Entity\BarArticle $article
     */
    public function removeArticle(\ApiBundle\Entity\BarArticle $article)
    {
        $this->articles->removeElement($article);
    }
}
