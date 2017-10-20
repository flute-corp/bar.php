<?php
namespace ApiBundle\Mixin;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

trait Labelisable {
    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, unique=true)
     * @JMS\Groups({"getArticles","getCategories", "getUsers", "postUsers"})
     *
     * @Assert\NotBlank(message="Un label est obligatoire")
     */
    protected $label;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Labelisable
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    public function __toString()
    {
        return $this->getLabel();
    }
}