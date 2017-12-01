<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends Controller
{


    /**
     * @Route("/")
     * @param LoggerInterface $log
     * @return Response
     */
    public function home(LoggerInterface $log)
    {
        $log->debug("OPvo je poroi");
        $var = "pero";
        return $this->render('home.html.twig', ['name' => $var]);
    }

    /**
     * @return Response
     * @Route("/index")
     */
    public function index()
    {
        return new Response("Ovo je rezulst");

    }
}