<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class PersonalSpaceController extends AbstractController
{
    #[Route('/personal/space', name: 'personal_space')]
    public function index(): Response
    {
        return $this->render('personal_space/index.html.twig');
    }
}
