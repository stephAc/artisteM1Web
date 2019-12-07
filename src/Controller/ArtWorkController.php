<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArtWorkRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArtWorkController extends AbstractController
{
    /**
     * @Route("/artworks/{categoryId}", name="artworks.index")
     */
    public function index(ArtWorkRepository $artWorkRepository, CategoryRepository $categoryRepository, int $categoryId){

        $category = $categoryRepository->findOneBy([
            'id' => $categoryId
        ]);

        $artPieces = $category->getName() == 'tout' ? $artWorkRepository->findAll() : $artWorkRepository->findBy(['category' => $category]);

        return $this->render('artWorks/index.html.twig', [
            'artPieces' => $artPieces,
        ]);
    }

    /**
     * @Route("/artwork/{artId}", name="artwok.detail")
     */
    public function detail(ArtWorkRepository $artWorkRepository, int $artId){
        $art = $artWorkRepository->findOneBy(['id' => $artId]);

        return $this->render('artWorks/detail.html.twig', [
            'art' => $art
        ]);
    }
}