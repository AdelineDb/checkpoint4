<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/artistes", name="admin_")
 */
class AdminArtistController extends AbstractController
{
    /**
     * @Route("/", name="artist_index", methods={"GET"})
     */
    public function index(ArtistRepository $artistRepository): Response
    {
        $bios = $artistRepository->findAll();

        $resumeBios = [];

        foreach ($bios as $bio){

            $res = explode(' ', $bio->getBiography());

            $res = array_slice($res, 0, 10);

            $res = implode(' ', $res);

            $res .= '...';

           $resumeBios[$bio->getId()] = $res;
        }


        return $this->render('admin/artist/index.html.twig', [
            'artists' => $artistRepository->findAll(),
            'resumeBios' => $resumeBios,

        ]);
    }

    /**
     * @Route("/new", name="artist_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artist);
            $entityManager->flush();

            $this->addFlash('success', 'L\'artiste a bien été ajouté');

            return $this->redirectToRoute('admin_artist_index');
        }

        return $this->render('admin/artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_show", methods={"GET"})
     */
    public function show(Artist $artist): Response
    {
        return $this->render('admin/artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artist_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Artist $artist): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\'artiste a bien été modifié');

            return $this->redirectToRoute('admin_artist_index');
        }

        return $this->render('admin/artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Artist $artist): Response
    {
        if ($this->isCsrfTokenValid('delete' . $artist->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artist);
            $entityManager->flush();

            $this->addFlash('danger', 'L\' artiste a bien été supprimé');
        }



        return $this->redirectToRoute('admin_artist_index');
    }
}
