<?php

namespace fabsalito\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $blogs = $em->getRepository('fabsalitoBlogBundle:Blog')
                    ->getLatestBlogs();

        return $this->render('fabsalitoBlogBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }
}