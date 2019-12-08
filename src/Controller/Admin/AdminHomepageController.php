<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin")
 */
class AdminHomepageController extends AbstractController
{
    /**
     * @Route("/", name="admin.index")
     */
    public function index()
    {
        return $this->render('admin/homepage/index.html.twig');
    }
}
