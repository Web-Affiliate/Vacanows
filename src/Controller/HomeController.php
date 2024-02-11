<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    #[Route('/', name: 'home')]
    public function index()
    {
        return $this->render('site/home/index.html.twig');
    }
}

?>
