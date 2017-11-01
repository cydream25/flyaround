<?php

namespace WCS\CoavBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ListingController extends Controller
{
    /**
     * @Route("/listing")
     */
    public function indexAction()
    {
        return $this->render('WCSCoavBundle:Listing:index.html.twig', array(
            // ...
        ));
    }

}
