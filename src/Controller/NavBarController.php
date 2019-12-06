<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavBarController extends AbstractController
{

    public function navBar(CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->findAll();

        return $this->render('inc/nav.html.twig', [
            'categorys' => $category,
        ]);
    }
}
