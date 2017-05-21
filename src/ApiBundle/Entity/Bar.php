<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bar
 *
 * @ORM\Table(name="bar")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\BarRepository")
 */
class Bar
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="BarArticle", mappedBy="bar")
     */
    private $articles;

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
     * @return Bar
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
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
