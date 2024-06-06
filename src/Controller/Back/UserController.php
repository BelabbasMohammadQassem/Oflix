<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserCreateType;
use App\Form\UserType;
use App\Form\UserUpdateType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_back_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('back/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_user_new', methods: ['GET', 'POST'])]
    public function new(UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(UserCreateType::class, $user);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $typedPassword = $form->get('password')->getData();
            // si un mot de passe est fourni
            if (! is_null($typedPassword))
            {
            // alors
                // on va hasher le nouveau mot de passe
                $hashedPassword = $hasher->hashPassword($user, $typedPassword);

                $user->setPassword($hashedPassword);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('back/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_user_edit', methods: ['GET', 'POST'])]
    public function edit(UserPasswordHasherInterface $hasher, Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* 
            Dans la classe de formulaire UserType, 
            on a mis le mot de passe en mapped = false
            ainsi le composant n'a pas rempli l'objet avec la valeur
            on met cela en place lorsqu'il y a de la logique spécifique
            à appliquer
            */
            $typedPassword = $form->get('password')->getData();
            // si un mot de passe est fourni
            if (! is_null($typedPassword))
            {
            // alors
                // on va hasher le nouveau mot de passe
                $hashedPassword = $hasher->hashPassword($user, $typedPassword);

                $user->setPassword($hashedPassword);
            }
            // sinon on laisse l'ancien mot de passe
            $entityManager->flush();

            return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
