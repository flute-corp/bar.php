<?php
namespace ApiBundle\Mixin;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait BlameableEntity
{
    /**
    * @var string
    * @Gedmo\Blameable(on="create")
    * @ORM\ManyToOne(targetEntity="\ApiBundle\Entity\User")
    * @ORM\JoinColumn(referencedColumnName="id")
    */
    protected $createdBy;

    /**
    * @var string
    * @Gedmo\Blameable(on="update")
    * @ORM\ManyToOne(targetEntity="\ApiBundle\Entity\User")
    * @ORM\JoinColumn(referencedColumnName="id")
    */
    protected $updatedBy;

    /**
    * Sets createdBy.
    *
    * @param  string $createdBy
    * @return $this
    */
    public function setCreatedBy($createdBy)
    {
    $this->createdBy = $createdBy;

    return $this;
    }

    /**
    * Returns createdBy.
    *
    * @return string
    */
    public function getCreatedBy()
    {
    return $this->createdBy;
    }

    /**
    * Sets updatedBy.
    *
    * @param  string $updatedBy
    * @return $this
    */
    public function setUpdatedBy($updatedBy)
    {
    $this->updatedBy = $updatedBy;

    return $this;
    }

    /**
    * Returns updatedBy.
    *
    * @return string
    */
    public function getUpdatedBy()
    {
    return $this->updatedBy;
    }
}