<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\Model\ContactModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact.form")
     */
    public function form(Request $request, \Swift_Mailer $mailer, Environment $twig):Response {

        $form = $this->createForm(ContactType::class, new ContactModel());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $message = new \Swift_Message();
            $message
                ->setFrom('aa476a2df4-00b8f0@inbox.mailtrap.io')
                ->setSubject('Contact')
                ->setContentType('text/html')
                ->setBody(
                    $twig->render('emailing/contact.html.twig', [
                        'data' => $form->getData()
                    ])
                )
                ->addPart(
                    $twig->render('emailing/contact.txt.twig', [
                        'data' => $form->getData()
                    ]), 'text/plain'
                );

            $mailer->send($message);

            $this->addFlash('notice', "Un email vient d'être envoyé");

            return $this->redirectToRoute('contact.form');
        }


        return $this->render('contact/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
