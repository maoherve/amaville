<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $annoncesRepository = $this->getDoctrine()
            ->getRepository(Annonces::class)
            ->findAll();

        return $this->render('home/index.html.twig', [
            'annonces' => $annoncesRepository,
        ]);
    }
}
