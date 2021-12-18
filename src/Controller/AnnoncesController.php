<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\User;
use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @IsGranted("ROLE_USER")
 */
#[Route('/annonces')]
class AnnoncesController extends AbstractController
{
    #[Route('/', name: 'annonces_index', methods: ['GET'])]
    public function index(AnnoncesRepository $annoncesRepository ): Response
    {
        $user = $this->getUser();

        $annoncesRepository = $this->getDoctrine()
            ->getRepository(Annonces::class)
            ->findBy(['user' => $user]);

        return $this->render('annonces/index.html.twig', [
            'annonces' => $annoncesRepository,
        ]);
    }

    #[Route('/new', name: 'annonces_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,UserInterface $user): Response
    {
        $annonce = new Annonces();

        //id utilisateur
        //$user = $this->getUser();


        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $annonce->setUser($user);

            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'annonces_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Annonces $annonce, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'annonces_delete', methods: ['POST'])]
    public function delete(Request $request, Annonces $annonce, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonces_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/lfisanel', name: 'lfisanel', methods: ['GET'])]
    public function admin(AnnoncesRepository $annoncesRepository ): Response
    {

        $annoncesRepository = $this->getDoctrine()
            ->getRepository(Annonces::class)
            ->findAll();

        return $this->render('annonces/admin_index.html.twig', [
            'annonces' => $annoncesRepository,
        ]);
    }
}
