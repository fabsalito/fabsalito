<?php

namespace fabsalito\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fabsalito\BlogBundle\Entity\Contact;
use fabsalito\BlogBundle\Form\ContactType;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('fabsalitoBlogBundle:Page:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('fabsalitoBlogBundle:Page:about.html.twig');
    }

    public function contactAction()
    {
        $contact = new Contact();

        $form = $this->createForm(new ContactType(), $contact);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // realiza alguna acción, como enviar un correo electrónico

                // Redirige - Esto es importante para prevenir que el usuario
                // reenvíe el formulario si actualiza la página
                return $this->redirect($this->generateUrl('fabsalito_blog_contact'));
            }
        }

        return $this->render('fabsalitoBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}