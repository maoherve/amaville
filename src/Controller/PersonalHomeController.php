<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class PersonalHomeController extends AbstractController
{
    #[Route('/personal/home', name: 'personal_home')]
    public function index(): Response
    {
        return $this->render('personal_home/index.html.twig', [
            'controller_name' => 'PersonalHomeController',
        ]);
    }
}
