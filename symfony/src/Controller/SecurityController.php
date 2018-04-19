<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @Route("/security")
 * @package App\Controller
 */
class SecurityController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     * @Template("security/index.html.twig")
     */
    public function index()
    {
        return [
            'controller_name' => 'SecurityController',
        ];
    }

    /**
     * @Route("/login", name="login")
     * @Template("security/login.html.twig")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return [
            'last_username' => $lastUsername,
            'error'         => $error,
        ];
    }

//    public function login(Request $request, AuthenticationUtils $authenticationUtils)
//    {
//         get the login error if there is one
//        $error = $authenticationUtils->getLastAuthenticationError();
//
//         last username entered by the user
//        $lastUsername = $authenticationUtils->getLastUsername();
//
//        $user = new User();
//        $form = $this->createFormBuilder($user)
//                     ->add('email', EmailType::class)
//                     ->add('password', PasswordType::class)
//                     ->add('save', SubmitType::class, array('label' => 'Login'))
//                     ->getForm();
//
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $userLogin = $form->getData();
//
//            $this->addFlash('notice', 'You are now logged-in !');
//
//            return $this->redirectToRoute('admin');
//        }
//
//        return [
//            'form' => $form->createView(),
//            'last_username' => $lastUsername,
//            'error'         => $error,
//        ];
//    }

}
