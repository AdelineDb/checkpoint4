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
 * @Route("/programmes", name="program")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="_index", methods={"GET"})
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

        return $this->render('program.html.twig', [
            'programs' => $programRepository->findAll(),
            'resumePrograms' => $resumePrograms,
            'type' => $programRepository->findAllWithType(),

        ]);
    }
}
