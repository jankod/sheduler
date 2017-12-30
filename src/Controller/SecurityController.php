<?php

namespace App\Controller;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\IsTrue;

class SecurityController extends Controller
{

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request, \Swift_Mailer $mail)
    {
        $registerModel = new RegisterModel();
        $form = $this->createFormBuilder($registerModel)
            ->add('email', EmailType::class, [
//                'attr' => ['placeholder' => 'Email']
            ])
            ->add('password1', PasswordType::class)
            ->add('password2', PasswordType::class)
            ->add('termsAccepted', CheckboxType::class, array(// 'constraints' => new IsTrue(),
            ))
            ->getForm();

//        FormError::
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var RegisterModel $data */
            $data = $form->getData();


            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('send@example.com')
                ->setTo('recipient@example.com')
                ->setBody('You should see me from the profiler!');

            $mail->send($message);

            dump('mail poslan');
            //  dump($data);

            //  return $this->redirectToRoute('home');
        }

        return $this->render('security/register.html.twig', ['form' => $form->createView()]);
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

class RegisterModel
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="80")
     * @Assert\Email()
     *
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="1000")
     */
    private $password1;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="1000")
     * Expression(expression=" this->password1===this->password2 ", message="Lozinke nisu jednake")
     * @Assert\EqualTo(propertyPath="password1", message="Lozinke nisu jednake")
     */
    private $password2;

    /**
     * @Assert\IsTrue(message="Mora biti selektirano ovo")
     */
    private $termsAccepted;

    /**
     * @return mixed
     */
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    /**
     * @param mixed $termsAccepted
     */
    public function setTermsAccepted($termsAccepted): void
    {
        $this->termsAccepted = $termsAccepted;
    }

    /**
     * @return string
     */
    public function getPassword2(): ?string
    {
        return $this->password2;
    }

    /**
     * @param string $password2
     */
    public function setPassword2($password2): void
    {
        $this->password2 = $password2;
    }

    /**
     * @return string
     */
    public function getPassword1(): ?string
    {
        return $this->password1;
    }

    /**
     * @param string $password
     */
    public function setPassword1($password): void
    {
        $this->password1 = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

}