<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PushSubscription
 *
 * @ORM\Table(name="push_subscription")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\PushSubscriptionRepository")
 */
class PushSubscription
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
     * @ORM\Column(name="endpoint", type="string", length=255)
     */
    private $endpoint;

    /**
     * @var PushKey
     *
     * @ORM\OneToOne(targetEntity="PushKey", inversedBy="id", cascade={"all"})
     */
    private $keys;

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
     * Set endpoint
     *
     * @param string $endpoint
     *
     * @return PushSubscription
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Get endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param PushKey $keys
     * @return PushSubscription
     */
    public function setKeys(PushKey $keys)
    {
        $this->keys = $keys;
        return $this;
    }

    /**
     * @return PushKey
     */
    public function getKeys()
    {
        return $this->keys;
    }
}

