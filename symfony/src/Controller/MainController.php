<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MainController extends Controller
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render(
            'main/index.html.twig',
            [
                'controller_name' => 'MainController',
            ]
        );
    }

    /**
     * @Route("/new", name="new")
     * @Template("main/new.html.twig")
     *
     * @param $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function new(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
                     ->add('firstName', TextType::class)
                     ->add('lastName', TextType::class)
                     ->add('email', EmailType::class)
                     ->add('birthDate', BirthdayType::class)
                     ->add('save', SubmitType::class, array('label' => 'Register'))
                     ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $userSubmit = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userSubmit);
            $entityManager->flush();

            $this->addFlash('notice', 'Vous vous etes inscrits !');

            return $this->redirectToRoute('new');
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
