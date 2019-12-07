<?php

namespace App\Controller;

use App\Repository\ExhibitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExhibitionController extends AbstractController
{
    /**
     * @Route("/exhibition", name="exhibition.index")
     */
    public function index(ExhibitionRepository $exhibitionRepository)
    {
        $exhibitions = $exhibitionRepository->exhibitionCommingUp()->getResult();

        return $this->render('exhibition/index.html.twig', [
            'exhibitions' => $exhibitions,
        ]);
    }
}
