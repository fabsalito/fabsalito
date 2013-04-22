<?php

namespace fabsalito\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fabsalito\FrontendBundle\Entity\Contact;
use fabsalito\FrontendBundle\Form\ContactType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBundle:Default:index.html.twig', array());
    }

    public function aboutAction()
    {
        return $this->render('FrontendBundle:Default:about.html.twig');
    }

    public function contactAction()
    {
        $contact = new Contact();

        $form = $this->createForm(new ContactType(), $contact);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact from fabsalito.com')
                    ->setFrom('fabricio.salinas@gmail.com')
                    ->setTo($this->container->getParameter('frontend.emails.contact_email'))
                    ->setBody($this->renderView('FrontendBundle:Default:contactEmail.txt.twig', array('enquiry' => $contact)));
                
                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

                // Redirige - Esto es importante para prevenir que el usuario
                // reenvíe el formulario si actualiza la página
                return $this->redirect($this->generateUrl('frontend_contact'));
            }
        }

        return $this->render('FrontendBundle:Default:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function sidebarAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $blogLimit = $this->container->getParameter('frontend.blogs.latest_blog_limit');

        $latestBlogs = $em->getRepository('fabsalitoBlogBundle:Blog')
                          ->getLatestBlogs($blogLimit);

        //\Doctrine\Common\Util\Debug::dump($latestBlogs);

        return $this->render('FrontendBundle:Default:sidebar.html.twig', array(
            'latestBlogs' => $latestBlogs
        ));
    }
}
