<?php

namespace fabsalito\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('fabsalitoBlogBundle:Page:index.html.twig');
    }
}