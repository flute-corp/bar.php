<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as JMS;

class ArticlesController extends Controller
{
    /**
     * @JMS\View(serializerGroups={"getArticles"})
     * @return \ApiBundle\Entity\Article[]
     */
    public function getArticlesAction()
    {
        return $this->getDoctrine()->getRepository('ApiBundle:Article')->findAll();
    }

}
