<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/user', name: 'user_index', methods: ['GET', 'POST'])]
    public function index(Request $request)
    {
        $users = $this->userRepository->findAllUsers();

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userRepository->addUser($user->getFirstName(), $user->getLastName(), $user->getAddress());

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/delete/{id}', name: 'user_delete', methods: ['POST', 'DELETE'])]
    public function delete(int $id)
    {
        $this->userRepository->deleteUserById($id);
        return $this->redirectToRoute('user_index');
    }
}
