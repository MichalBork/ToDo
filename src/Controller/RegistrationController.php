<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegistrationController extends AbstractController
{

    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }


    #[Route('/registration', name: 'registration')]
    public function registrationForm(Request $request, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->registerNewUser($user, $passwordEncoder, $form);
        }


        return $this->render('registration/registration.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @param User $user
     * @param UserPasswordHasherInterface $passwordEncoder
     * @param FormInterface $form
     * @return RedirectResponse
     */
    public function registerNewUser(
        User $user,
        UserPasswordHasherInterface $passwordEncoder,
        FormInterface $form
    ): RedirectResponse {
        $user->setPassword(
            $passwordEncoder->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            )
        );


        $this->userRepository->save($user);


        return $this->redirectToRoute('app_login');
    }

}