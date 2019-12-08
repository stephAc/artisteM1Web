<?php

namespace App\Controller\Admin;

use App\Entity\ArtWork;
use App\Form\ArtWorkType;
use App\Repository\ArtWorkRepository;
use App\Service\FileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/form", name="admin.artwork.form")
     * @Route("/form/update/{id}", name="admin.artwork.form.update")
     */
    public function form(Request $request, EntityManagerInterface $entityManagerInterface, int $id = null, ArtWorkRepository $artWorkRepository): Response {

        $model = $id ? $artWorkRepository->find($id) : new ArtWork();
        $type = ArtWorkType::class;
        $form = $this->createForm($type, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $message = $model->getId() ? "L'oeuvre a été modifié" : "L'oeuvre à été ajouté";

            $entityManagerInterface->persist($form->getData());
            $entityManagerInterface->flush();

            $this->addFlash('notice', $message);

            return $this->redirectToRoute('admin.artwork.index');
        }

        return $this->render('admin/artwork/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/form/remove/{id}", name="admin.artwork.remove")
     */
    public function remove(ArtWorkRepository $artWorkRepository, EntityManagerInterface $entityManagerInterface, int $id, FileService $fileService): Response{

        $model = $artWorkRepository->find($id);

        $entityManagerInterface->remove($model);
        $entityManagerInterface->flush();

        if(file_exists("img/artwork/{$model->getImage()}")){
            dump("img/artwork/{$model->getImage()}");
            $fileService->remove('img/artwork', $model->getImage());

        }
        $this->addFlash('notice', "L'oeuvre a été supprimé");
        return $this->redirectToRoute('admin.artwork.index');
    }
}
