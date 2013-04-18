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

    public function sidebarAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $tags = $em->getRepository('fabsalitoBlogBundle:Blog')
                   ->getTags();

        $tagWeights = $em->getRepository('fabsalitoBlogBundle:Blog')
                         ->getTagWeights($tags);

        $commentLimit   = $this->container
                           ->getParameter('fabsalito_blog.comments.latest_comment_limit');
        
        $latestComments = $em->getRepository('fabsalitoBlogBundle:Comment')
                             ->getLatestComments($commentLimit);

        return $this->render('fabsalitoBlogBundle:Page:sidebar.html.twig', array(
            'latestComments' => $latestComments,
            'tags' => $tagWeights
        ));
    }
}