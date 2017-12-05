<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    /**
     * @Route("/register", name="register")
     */
    public function register()
    {
        return $this->render('security/register.html.twig');
    }

    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     * @param LoggerInterface $log
     * @return Response
     */
    public function login(Request $request, AuthenticationUtils $authUtils, LoggerInterface $log)
    {

      //  $log->debug('logger evo me '. $request->get('_username') );
        // get the login error if there is one
        dump($request->request->all());
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));

    }
}
