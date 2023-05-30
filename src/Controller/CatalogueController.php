<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class CatalogueController extends AbstractController
{

    #[Route('/', name: 'app_voiture_catalogue')]
    public function showAll(
        VoitureRepository $voitureRepository,
        LieuRepository    $lieuRepository,
    ): Response
    {
        $villes = [];
        foreach ($lieuRepository->findAll() as $lieu) {
            $villes[] = $lieu->getVille();
            $villes = array_unique($villes);
        }

        return $this->render('catalogue/index.html.twig', [
            'villes' => $villes,
            'voitures' => $voitureRepository->findAll(),
        ]);
    }

    #[Route('/filtrer', name: 'voiture_filter', methods: ['GET'])]
    public function filterByCity(
        Request               $request,
        VoitureRepository     $voitureRepository,
        LieuRepository        $lieuRepository
    ): Response
    {
        $ville = $request->query->get('ville');
        $filteredVilles = [];
        if ($ville === 'toutes') {
            $lieux = $lieuRepository->findAll();
            foreach ($lieux as $lieu) {
                $filteredVilles[] = $lieu->getVille();
                $filteredVilles = array_unique($filteredVilles);
            }
        } else {
            $lieux = $lieuRepository->findBy(['ville' => $ville]);
            foreach ($lieux as $lieu) {
                $filteredVilles[] = $lieu->getVille();
                $filteredVilles = array_unique($filteredVilles);
            }
        }

        $filteredVoitures = $voitureRepository->findBy(['garage' => $lieux]);

        $villes = [];
        foreach ($lieuRepository->findAll() as $lieu) {
            $villes[] = $lieu->getVille();
            $villes = array_unique($villes);
        }

        return $this->render('catalogue/index.html.twig', [
            'villes' => $villes,
            'voitures' => $filteredVoitures,
        ]);
    }

}