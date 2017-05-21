<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RootController extends Controller
{
    public function getAction()
    {
        return $this->getDoctrine()->getRepository('ApiBundle:Categorie')->findAll();
    }
}
