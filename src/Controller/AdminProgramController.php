<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/programmes", name="admin_")
 */
class AdminProgramController extends AbstractController
{
    /**
     * @Route("/", name="program_index", methods={"GET"})
     */
    public function index(ProgramRepository $programRepository): Response
    {

        $programs = $programRepository->findAll();

        $resumeBios = [];

        foreach ($programs as $program) {

            $res = explode(' ', $program->getDescription());

            $res = array_slice($res, 0, 10);

            $res = implode(' ', $res);

            $res .= '...';

            $resumePrograms[$program->getId()] = $res;
        }

        return $this->render('admin/program/index.html.twig', [
            'programs' => $programRepository->findAll(),
            'resumePrograms' => $resumePrograms,
            'type' => $programRepository->findAllWithType(),

        ]);
    }

    /**
     * @Route("/ajout", name="program_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($program);
            $entityManager->flush();

            $this->addFlash('success', 'Le numéro a bien été ajouté');

            return $this->redirectToRoute('admin_program_index');
        }

        return $this->render('admin/program/new.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_show", methods={"GET"})
     */
    public function show(Program $program): Response
    {
        return $this->render('admin/program/show.html.twig', [
            'program' => $program,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="program_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Program $program): Response
    {
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le numéro a bien été modifié');

            return $this->redirectToRoute('admin_program_index');
        }


        return $this->render('admin/program/edit.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Program $program): Response
    {
        if ($this->isCsrfTokenValid('delete' . $program->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($program);
            $entityManager->flush();

            $this->addFlash('danger', 'Le numéro a bien été supprimé');

        }

        return $this->redirectToRoute('admin_program_index');
    }
}
