<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/serie")
 */
class SerieController extends AbstractController
{
    /**
     * @Route("/", name="serie_index")
     */
    public function index(SerieRepository $serieRepository): Response
    {
        // TODO: Récupérer la liste des séries en base de données
        //$serie = $serieRepository->findby([], ['popularity' => 'DESC', 'vote' => 'DESC'], 30);

        $serie = $serieRepository->findBest();

        return $this->render('serie/index.html.twig', ['series' => $serie]);

    }

    /**
     * @Route("/{id}", name="serie_show", requirements={"id"="\d+"})
     */
    public function show(int $id, SerieRepository $serieRepository): Response
    {
        // TODO: Récupérer en base de données la série ayant l'id $id
        $serie = $serieRepository->find($id); // SELECT * FROM serie WHERE id = $id

        if ($serie === null) {
            throw $this->createNotFoundException("cette série n'existe pas");
        }

        return $this->render('serie/show.html.twig', [
            'serie' => $serie
        ]);
    }

    /**
     * @Route("/new", name="serie_new")
     */
    public function new(): Response
    {
        return $this->render('serie/new.html.twig');
    }


}
