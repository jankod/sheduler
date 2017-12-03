<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends Controller
{


    /**
     * @Route("/", name="home")
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
     * @Route("/second", name="second")
     */
    public function second()
    {
        return $this->render('second.html.twig');

    }

    /**
     * @Route("/page1")
     */
    public function page1()
    {
        return $this->render('page1.html.twig');
    }
}