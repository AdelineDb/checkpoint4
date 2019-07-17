<?php
/**
 * Created by PhpStorm.
 * User: adeli
 * Date: 17/07/2019
 * Time: 14:31
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @package App\Controller
 * @Route("/", name="")
 */

class IndexController extends AbstractController

{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

}