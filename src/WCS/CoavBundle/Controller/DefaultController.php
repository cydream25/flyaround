<?php

namespace WCS\CoavBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->getDoctrine();
        return $this->render('WCSCoavBundle:Default:index.html.twig');
    }
}
