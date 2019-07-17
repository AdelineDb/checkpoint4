<?php
/**
 * Created by PhpStorm.
 * User: adeli
 * Date: 16/07/2019
 * Time: 12:24
 */
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */

    public function index(UserRepository $userRepository)
    {

        return $this->render('admin/index.html.twig');
    }



}