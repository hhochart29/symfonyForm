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
use Symfony\Component\Translation\TranslatorInterface;

class MainController extends Controller
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/main", name="main")
     */
    public function index(TranslatorInterface $translator)
    {
        $controllerName = $translator->trans('MainController');
        return $this->render(
            'main/index.html.twig',
            [
                'controller_name' => $controllerName,
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
            $userSubmit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userSubmit);
            $entityManager->flush();

            $this->addFlash('notice', 'You are now registered !');
            $this->sendMail($user->getEmail(), $user->getFirstName());

            return $this->redirectToRoute('new');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    private function sendMail($email, $name)
    {
        $message = (new \Swift_Message('Thank you for your registration'))
            ->setFrom('symfony@example.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'emails/registration.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

}
