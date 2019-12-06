<?php

namespace App\Controller;

use App\Repository\ArtWorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="homepage.index")
     */
    public function index(ArtWorkRepository $artWorkRepository)
    {
        $pic = $artWorkRepository->findBy([], null, 4, 0);

        return $this->render('homepage/index.html.twig', [
            'picTab' => $pic,
        ]);
    }
}
