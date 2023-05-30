<?php

namespace App\Controller;

use App\Entity\Garage;
use App\Form\GarageType;
use App\Repository\GarageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/garage')]
class GarageController extends AbstractController
{
    #[Route('/', name: 'app_garage_index', methods: ['GET'])]
    public function index(GarageRepository $garageRepository): Response
    {
        return $this->render('garage/index.html.twig', [
            'garages' => $garageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_garage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GarageRepository $garageRepository): Response
    {
        $garage = new Garage();
        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $garageRepository->save($garage, true);

            return $this->redirectToRoute('app_garage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('garage/new.html.twig', [
            'garage' => $garage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_garage_show', methods: ['GET'])]
    public function show(Garage $garage): Response
    {
        return $this->render('garage/show.html.twig', [
            'garage' => $garage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_garage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Garage $garage, GarageRepository $garageRepository): Response
    {
        $form = $this->createForm(GarageType::class, $garage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $garageRepository->save($garage, true);

            return $this->redirectToRoute('app_garage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('garage/edit.html.twig', [
            'garage' => $garage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_garage_delete', methods: ['POST'])]
    public function delete(Request $request, Garage $garage, GarageRepository $garageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$garage->getId(), $request->request->get('_token'))) {
            $garageRepository->remove($garage, true);
        }

        return $this->redirectToRoute('app_garage_index', [], Response::HTTP_SEE_OTHER);
    }
}
