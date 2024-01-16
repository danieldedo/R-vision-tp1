<?php

namespace App\Controller;

use App\Entity\Sejour;
use App\Form\SejourType;
use App\Repository\SejourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/sejour')]
class SejourController extends AbstractController
{
    #[Route('/', name: 'app_sejour_index', methods: ['GET'])]
    public function index(SejourRepository $sejourRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $sejours = $paginator->paginate(
            $sejourRepository->findBy([],['id' => 'DESC']),
            $request->query->getInt('page',1),
            2
        );

        return $this->render('sejour/index.html.twig', [
            'sejours' => $sejours,
        ]);
    }

    #[Route('/new', name: 'app_sejour_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sejour = new Sejour();
        $form = $this->createForm(SejourType::class, $sejour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sejour);
            $entityManager->flush();
            
            $this->addFlash('success','enregistrement éffectué avec succès');
            return $this->redirectToRoute('app_sejour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sejour/new.html.twig', [
            'sejour' => $sejour,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/search', name: 'app_sejour_search', methods: ['GET', 'POST'])]
    public function Search(Request $request,
    EntityManagerInterface $entityManager,
    SejourRepository $sejourRepository,
    ): Response
    {

        $searchTerm  = $request->request->get('name');
       
        if ($searchTerm) {
            $sejours = $sejourRepository->findByVoyageurNameOrPrenom($searchTerm);
        } else {
            $sejours = null;
        }

        // dd($sejours);

        return $this->render('sejour/search_voyage.html.twig', [
            'sejours'=> $sejours,
        ]);
    }

    #[Route('/{id}', name: 'app_sejour_show', methods: ['GET'])]
    public function show(Sejour $sejour): Response
    {
        return $this->render('sejour/show.html.twig', [
            'sejour' => $sejour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sejour_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sejour $sejour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SejourType::class, $sejour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sejour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sejour/edit.html.twig', [
            'sejour' => $sejour,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'app_sejour_delete', methods: ['POST','GET'])]
    public function delete(Request $request, Sejour $sejour, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($sejour);
        $entityManager->flush();
        $this->addFlash('error','enregistrement supprimer avec success');
        return $this->redirectToRoute('app_sejour_index', [], Response::HTTP_SEE_OTHER);
    }
}
