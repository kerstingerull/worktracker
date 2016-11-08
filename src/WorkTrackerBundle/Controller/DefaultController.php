<?php

namespace WorkTrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WorkTrackerBundle:Default:index.html.twig');
    }
}
