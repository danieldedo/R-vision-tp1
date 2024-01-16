<?php

namespace App\Controller;

use App\Entity\Voyageur;
use App\Form\VoyageurType;
use App\Repository\VoyageurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/voyageur')]
class VoyageurController extends AbstractController
{
    #[Route('/', name: 'app_voyageur_index', methods: ['GET'])]
    public function index(VoyageurRepository $voyageurRepository,PaginatorInterface $paginator, Request $request): Response
    {

        $voyageurs = $paginator->paginate(
            $voyageurRepository->findBy([],['id' => 'DESC']),
            $request->query->getInt('page',1),
            2
        );
        return $this->render('voyageur/index.html.twig', [
            'voyageurs' => $voyageurs,
        ]);
    }

    #[Route('/new', name: 'app_voyageur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voyageur = new Voyageur();
        $form = $this->createForm(VoyageurType::class, $voyageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voyageur);
            $entityManager->flush();

            return $this->redirectToRoute('app_voyageur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyageur/new.html.twig', [
            'voyageur' => $voyageur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_voyageur_show', methods: ['GET'])]
    public function show(Voyageur $voyageur): Response
    {
        return $this->render('voyageur/show.html.twig', [
            'voyageur' => $voyageur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voyageur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voyageur $voyageur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoyageurType::class, $voyageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voyageur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voyageur/edit.html.twig', [
            'voyageur' => $voyageur,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'app_voyageur_delete', methods: ['POST','GET'])]
    public function delete(Voyageur $voyageur, EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($voyageur);
        $entityManager->flush();
        $this->addFlash('error','L\'enregistrement a été supprimer avec success');
        return $this->redirectToRoute('app_voyageur_index', [], Response::HTTP_SEE_OTHER);
    }
}
