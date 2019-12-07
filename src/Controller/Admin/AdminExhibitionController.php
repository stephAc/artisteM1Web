<?php

namespace App\Controller\Admin;

use App\Repository\ExhibitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/exhibition")
 */
class AdminExhibitionController extends AbstractController
{
    /**
     * @Route("/", name="admin.exhibition")
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
}
