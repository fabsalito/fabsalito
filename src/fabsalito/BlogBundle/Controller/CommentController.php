<?php

namespace fabsalito\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fabsalito\BlogBundle\Entity\Comment;
use fabsalito\BlogBundle\Form\CommentType;

class CommentController extends Controller
{
    // public function indexAction()
    // {
    //     return $this->render('fabsalitoBlogBundle:Comment:index.html.twig');
    // }

    public function newAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment = new Comment();
        $comment->setBlog($blog);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('fabsalitoBlogBundle:Comment:includes/form.html.twig', array(
            'comment'   => $comment,
            'form'      => $form->createView()
        ));
    }

    public function createAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);

        $comment  = new Comment();
        $comment->setBlog($blog);
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getManager();
            $em->persist($comment);
            $em->flush();

            //$this->get('session')->getFlashBag()->add('comment-notice', 'Your contact enquiry was successfully sent. Thank you!');

            return $this->redirect($this->generateUrl('fabsalito_blog_show', array(
                'id' => $comment->getBlog()->getId(),
                'slug' => $comment->getBlog()->getSlug()
                )) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('fabsalitoBlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getBlog($blog_id)
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $blog = $em->getRepository('fabsalitoBlogBundle:Blog')->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }
}