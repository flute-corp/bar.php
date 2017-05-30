<?php
namespace ApiBundle\Mixin;

use Doctrine\ORM\Mapping as ORM;

trait Labelisable {
    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, unique=true)
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