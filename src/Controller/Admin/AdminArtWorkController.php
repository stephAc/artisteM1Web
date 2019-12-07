<?php

namespace App\Controller\Admin;

use App\Repository\ArtWorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/artworks")
 */
class AdminArtWorkController extends AbstractController
{
    /**
     * @Route("/", name="admin.artwork.index")
     */
    public function index(ArtWorkRepository $artWorkRepository):Response {

        $artworks = $artWorkRepository->findAll();

        return $this->render('admin/artwork/index.html.twig', [
            'artPieces' => $artworks,
        ]);
    }
}
