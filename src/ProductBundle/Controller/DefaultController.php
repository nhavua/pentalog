<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProductBundle:Default:index.html.twig');
    }

    public function homepageAction()
    {
        return $this->render('ProductBundle:Default:homepage.html.twig');
    }
}
