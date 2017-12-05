<?php


namespace App\Controller;


use App\Entity\User;
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

        $m = $this->getDoctrine()->getManager();
//        $user = new User();
//        $user->setActive(true)
//            ->setEmail('jdiminic@gmailc.om')
//            ->setUsername($user->getEmail())
//            ->setPassword('sdfdsfsdfweqr');
//        $m->persist($user);
//        $m->flush();
        $repo = $this->getDoctrine()->getRepository(User::class);
        
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
     * @Route("/page1", name="page1")
     */
    public function page1()
    {
        return $this->render('page1.html.twig');
    }
}