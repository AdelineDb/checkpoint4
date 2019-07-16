<?php
/**
 * Created by PhpStorm.
 * User: adeli
 * Date: 16/07/2019
 * Time: 12:24
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */

    public function index()
    {
        return $this->render('admin/index.html.twig');
    }



}