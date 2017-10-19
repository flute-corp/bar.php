<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as JMS;

class BarsController extends Controller
{
    private function findAll($entityNs) {
        return $this->getDoctrine()->getRepository($entityNs)->createQueryBuilder('qb','qb.id')->getQuery()->getResult();
    }
    /**
     * @return array
     *
     * @JMS\View(serializerGroups={"getArticles","getCategories","getUsers"})
     */
    public function getAction() {
        return array(
            'articles' => $this->findAll('ApiBundle:Article'),
            'categories' => $this->findAll('ApiBundle:Categorie'),
            'users' => $this->findAll('ApiBundle:User')
        );
    }
//
//
//    public function getBarAction(Bar $bar) {
//        return $bar;
//    }
}
