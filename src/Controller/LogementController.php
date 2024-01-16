<?php

namespace App\Controller;

use App\Entity\Logement;
use App\Form\LogementType;
use App\Repository\LogementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

// #[Route('/logement')]
class LogementController extends AbstractController
{
    #[Route('/', name: 'app_logement_index', methods: ['GET'])]
    public function index(LogementRepository $logementRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $logements = $paginator->paginate(
            $logementRepository->findBy([],['id' => 'DESC']),
            $request->query->getInt('page',1),
            2
        );
        return $this->render('logement/index.html.twig', [
            'logements' => $logements,
        ]);
    }

    #[Route('/logement/new', name: 'app_logement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $logement = new Logement();
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $photo = $form->get('photo')->getData();

            // this condition is needed because the 'photo' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {

                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                // Move the file to the directory where photos are stored
                try {
                    $photo->move(
                        $this->getParameter('photo_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo "Mal partir";
                    // ... handle exception if something happens during file upload
                }

                // updates the 'photoFilename' property to store the PDF file name
                // instead of its contents
                $logement->setPhoto($newFilename);
            }
            // dd($logement);
            $entityManager->persist($logement);
            $entityManager->flush();

            $this->addFlash('success','enregistrement éffectué avec succès');
            return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('logement/new.html.twig', [
            'logement' => $logement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/logement/{id}', name: 'app_logement_show', methods: ['GET'])]
    public function show(Logement $logement): Response
    {
        return $this->render('logement/show.html.twig', [
            'logement' => $logement,
        ]);
    }

    #[Route('/logement/{id}/edit', name: 'app_logement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Logement $logement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            
            $this->addFlash('success','modification éffectué avec succès');
            return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('logement/edit.html.twig', [
            'logement' => $logement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/logement/{id}/delete', name: 'app_logement_delete', methods: ['POST','GET'])]
    public function delete(Request $request, Logement $logement, EntityManagerInterface $entityManager): Response
    {
            $entityManager->remove($logement);
            $entityManager->flush();
            $this->addFlash('error','enregistrement supprimer avec success');
        return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
    }
}
