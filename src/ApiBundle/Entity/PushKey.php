<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PushKey
 *
 * @ORM\Table(name="push_key")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\PushKeyRepository")
 */
class PushKey
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
     * @ORM\Column(name="p256dh", type="string", length=255)
     */
    private $p256dh;

    /**
     * @var string
     *
     * @ORM\Column(name="auth", type="string", length=255)
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
     * Set p256dh
     *
     * @param string $p256dh
     *
     * @return PushKey
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
     * @return PushKey
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

