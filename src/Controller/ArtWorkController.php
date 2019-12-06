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
            'id' => $categoryId]);

        if($category->getName() == 'tout'){
            dd($artWorkRepository->findAll());
        }else{
            dd($artWorkRepository->findBy( ['category_id' => $category]));
        }

        return $this->render('artWorks/index.html.twig', [
            'controller_name' => 'ArtWorkController',
        ]);
    }
}
