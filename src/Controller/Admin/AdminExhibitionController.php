<?php

namespace App\Controller\Admin;

use App\Entity\Exhibition;
use App\Form\ExhibitionType;
use App\Repository\ExhibitionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/exhibition")
 */
class AdminExhibitionController extends AbstractController
{
    /**
     * @Route("/", name="admin.exhibition.index")
     */
    public function index(ExhibitionRepository $exhibitionRepository)
    {

        $exhibitionCommingUp = $exhibitionRepository->exhibitionCommingUp()->getResult();
        $exhibitionPassed = $exhibitionRepository->passedExhibition()->getResult();

        return $this->render('admin/exhibition/index.html.twig', [
            'exhibitionCommingUp' => $exhibitionCommingUp,
            'passedExhibitions' => $exhibitionPassed
        ]);
    }

    /**
     * @Route("/form", name="admin.exhibition.form")
     */
    public function form(Request $request, EntityManagerInterface $entityManager):Response{
        $form = $this->createForm(ExhibitionType::class, new Exhibition());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('notice', "L'exhibition à été ajouté");

            return $this->redirectToRoute('admin.exhibition.index');
        }

        return $this->render('admin/exhibition/form.html.twig', [
           'form' => $form->createView()
        ]);

    }
}
