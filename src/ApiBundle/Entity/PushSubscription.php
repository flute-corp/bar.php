<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

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
     * @ORM\Column(name="endpoint", type="string", length=255, unique=true)
     * @JMS\Groups({"postSubscription"})
     */
    private $endpoint;

    /**
     * @var string
     *
     * @ORM\Column(name="p256dh", type="string", length=255)
     * @JMS\Groups({"postSubscription"})
     */
    private $p256dh;

    /**
     * @var string
     *
     * @ORM\Column(name="auth", type="string", length=255)
     * @JMS\Groups({"postSubscription"})
     */
    private $auth;

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
     * Set p256dh
     *
     * @param string $p256dh
     *
     * @return PushSubscription
     */
    public function setP256dh($p256dh)
    {
        $this->p256dh = $p256dh;

        return $this;
    }

    /**
     * Get p256dh
     *
     * @return string
     */
    public function getP256dh()
    {
        return $this->p256dh;
    }

    /**
     * Set auth
     *
     * @param string $auth
     *
     * @return PushSubscription
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;

        return $this;
    }

    /**
     * Get auth
     *
     * @return string
     */
    public function getAuth()
    {
        return $this->auth;
    }
}

